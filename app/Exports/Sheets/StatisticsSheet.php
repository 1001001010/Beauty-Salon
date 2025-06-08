<?php

namespace App\Exports\Sheets;

use App\Models\User;
use App\Models\Service;
use App\Models\Master;
use App\Models\Record;
use App\Models\Feedback;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\FromCollection;

class StatisticsSheet implements WithTitle, WithCustomStartCell, ShouldAutoSize, WithStyles, FromCollection
{
    public function title(): string
    {
        return 'Статистика';
    }

    public function startCell(): string
    {
        return 'A1';
    }

    public function collection()
    {
        // Общая статистика
        $totalUsers = User::count();
        $totalClients = User::where('role', 'user')->count();
        $totalAdmins = User::where('role', 'admin')->count();
        $totalMasters = Master::count();
        $totalServices = Service::count();
        $totalRecords = Record::count();
        $totalFeedback = Feedback::count();

        // Статистика по услугам
        $topServices = Service::select('services.name', DB::raw('COUNT(records.id) as record_count'))
            ->leftJoin('master_service', 'services.id', '=', 'master_service.service_id')
            ->leftJoin('records', 'master_service.id', '=', 'records.master_service_id')
            ->groupBy('services.id', 'services.name')
            ->orderBy('record_count', 'desc')
            ->limit(5)
            ->get();

        // Статистика по мастерам
        $topMasters = Master::select(
            DB::raw("CONCAT(masters.surname, ' ', masters.name) as master_name"),
            DB::raw('COUNT(records.id) as record_count')
        )
            ->leftJoin('master_service', 'masters.id', '=', 'master_service.master_id')
            ->leftJoin('records', 'master_service.id', '=', 'records.master_service_id')
            ->groupBy('masters.id', 'masters.name', 'masters.surname')
            ->orderBy('record_count', 'desc')
            ->limit(5)
            ->get();

        // Статистика по месяцам
        $recordsByMonth = Record::select(
            DB::raw('MONTH(datetime) as month'),
            DB::raw('YEAR(datetime) as year'),
            DB::raw('COUNT(*) as count')
        )
            ->whereYear('datetime', date('Y'))
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get()
            ->map(function ($item) {
                $monthNames = [
                    1 => 'Январь',
                    2 => 'Февраль',
                    3 => 'Март',
                    4 => 'Апрель',
                    5 => 'Май',
                    6 => 'Июнь',
                    7 => 'Июль',
                    8 => 'Август',
                    9 => 'Сентябрь',
                    10 => 'Октябрь',
                    11 => 'Ноябрь',
                    12 => 'Декабрь'
                ];

                return [
                    'period' => $monthNames[$item->month] . ' ' . $item->year,
                    'count' => $item->count
                ];
            });

        // Формируем данные для отчета
        $data = [
            ['Статистика системы', ''],
            ['Показатель', 'Значение'],
            ['Всего пользователей', $totalUsers],
            ['Клиентов', $totalClients],
            ['Администраторов', $totalAdmins],
            ['Мастеров', $totalMasters],
            ['Услуг', $totalServices],
            ['Записей', $totalRecords],
            ['Отзывов', $totalFeedback],
            ['', ''],
            ['Топ-5 популярных услуг', ''],
            ['Услуга', 'Количество записей']
        ];

        foreach ($topServices as $service) {
            $data[] = [$service->name, $service->record_count];
        }

        $data[] = ['', ''];
        $data[] = ['Топ-5 популярных мастеров', ''];
        $data[] = ['Мастер', 'Количество записей'];

        foreach ($topMasters as $master) {
            $data[] = [$master->master_name, $master->record_count];
        }

        $data[] = ['', ''];
        $data[] = ['Статистика записей по месяцам', ''];
        $data[] = ['Месяц', 'Количество записей'];

        foreach ($recordsByMonth as $record) {
            $data[] = [$record['period'], $record['count']];
        }

        return collect($data);
    }

    public function styles(Worksheet $sheet)
    {
        // Стиль для заголовков разделов
        $sectionHeaderStyle = [
            'font' => [
                'bold' => true,
                'size' => 14,
                'color' => ['rgb' => '000000'],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'BDD7EE'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
            ],
        ];

        // Стиль для заголовков таблиц
        $tableHeaderStyle = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '4472C4'],
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
            ],
        ];

        // Стиль для данных
        $dataStyle = [
            'font' => [
                'color' => ['rgb' => '000000'],
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ];

        // Получаем данные для правильного расчета количества строк
        $topServices = Service::select('services.name', DB::raw('COUNT(records.id) as record_count'))
            ->leftJoin('master_service', 'services.id', '=', 'master_service.service_id')
            ->leftJoin('records', 'master_service.id', '=', 'records.master_service_id')
            ->groupBy('services.id', 'services.name')
            ->orderBy('record_count', 'desc')
            ->limit(5)
            ->get();

        $topMasters = Master::select(
            DB::raw("CONCAT(masters.surname, ' ', masters.name) as master_name"),
            DB::raw('COUNT(records.id) as record_count')
        )
            ->leftJoin('master_service', 'masters.id', '=', 'master_service.master_id')
            ->leftJoin('records', 'master_service.id', '=', 'records.master_service_id')
            ->groupBy('masters.id', 'masters.name', 'masters.surname')
            ->orderBy('record_count', 'desc')
            ->limit(5)
            ->get();

        $recordsByMonth = Record::select(
            DB::raw('MONTH(datetime) as month'),
            DB::raw('YEAR(datetime) as year'),
            DB::raw('COUNT(*) as count')
        )
            ->whereYear('datetime', date('Y'))
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        // Заголовок листа - убираем, так как он уже в данных
        $sheet->getStyle('A1:B1')->applyFromArray($sectionHeaderStyle);
        $sheet->mergeCells('A1:B1');

        // Общая статистика - заголовки столбцов
        $sheet->getStyle('A2:B2')->applyFromArray($tableHeaderStyle);

        // Общая статистика - данные
        $sheet->getStyle('A3:B9')->applyFromArray($dataStyle);

        // Топ услуг - заголовок раздела
        $sheet->getStyle('A11:B11')->applyFromArray($sectionHeaderStyle);
        $sheet->mergeCells('A11:B11');

        // Топ услуг - заголовки столбцов
        $sheet->getStyle('A12:B12')->applyFromArray($tableHeaderStyle);

        // Топ услуг - данные
        $topServicesCount = $topServices->count();
        if ($topServicesCount > 0) {
            $lastServiceRow = 12 + $topServicesCount;
            $sheet->getStyle('A13:B' . $lastServiceRow)->applyFromArray($dataStyle);
            $masterStartRow = $lastServiceRow + 2;
        } else {
            $masterStartRow = 14;
        }

        // Топ мастеров - заголовок раздела
        $sheet->getStyle('A' . $masterStartRow . ':B' . $masterStartRow)->applyFromArray($sectionHeaderStyle);
        $sheet->mergeCells('A' . $masterStartRow . ':B' . $masterStartRow);

        // Топ мастеров - заголовки столбцов
        $sheet->getStyle('A' . ($masterStartRow + 1) . ':B' . ($masterStartRow + 1))->applyFromArray($tableHeaderStyle);

        // Топ мастеров - данные
        $topMastersCount = $topMasters->count();
        if ($topMastersCount > 0) {
            $lastMasterRow = $masterStartRow + 1 + $topMastersCount;
            $sheet->getStyle('A' . ($masterStartRow + 2) . ':B' . $lastMasterRow)->applyFromArray($dataStyle);
            $monthStartRow = $lastMasterRow + 2;
        } else {
            $monthStartRow = $masterStartRow + 3;
        }

        // Статистика по месяцам - заголовок раздела
        $sheet->getStyle('A' . $monthStartRow . ':B' . $monthStartRow)->applyFromArray($sectionHeaderStyle);
        $sheet->mergeCells('A' . $monthStartRow . ':B' . $monthStartRow);

        // Статистика по месяцам - заголовки столбцов
        $sheet->getStyle('A' . ($monthStartRow + 1) . ':B' . ($monthStartRow + 1))->applyFromArray($tableHeaderStyle);

        // Статистика по месяцам - данные
        $recordsByMonthCount = $recordsByMonth->count();
        if ($recordsByMonthCount > 0) {
            $lastMonthRow = $monthStartRow + 1 + $recordsByMonthCount;
            $sheet->getStyle('A' . ($monthStartRow + 2) . ':B' . $lastMonthRow)->applyFromArray($dataStyle);
        }

        return [];
    }
}
