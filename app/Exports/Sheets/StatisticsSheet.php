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
                    1 => 'Январь', 2 => 'Февраль', 3 => 'Март', 4 => 'Апрель',
                    5 => 'Май', 6 => 'Июнь', 7 => 'Июль', 8 => 'Август',
                    9 => 'Сентябрь', 10 => 'Октябрь', 11 => 'Ноябрь', 12 => 'Декабрь'
                ];

                return [
                    'period' => $monthNames[$item->month] . ' ' . $item->year,
                    'count' => $item->count
                ];
            });

        // Формируем данные для отчета
        $data = [
            ['Общая статистика системы', ''],
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
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ];

        // Применяем стили
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Общая статистика
        $sheet->getStyle('A2')->applyFromArray($sectionHeaderStyle);
        $sheet->getStyle('A3:B3')->applyFromArray($tableHeaderStyle);
        $sheet->getStyle('A4:B10')->applyFromArray($dataStyle);

        // Топ услуг
        $sheet->getStyle('A12')->applyFromArray($sectionHeaderStyle);
        $sheet->getStyle('A13:B13')->applyFromArray($tableHeaderStyle);

        // Находим последнюю строку с услугами
        $lastServiceRow = 13 + count(Service::select('services.name', DB::raw('COUNT(records.id) as record_count'))
            ->leftJoin('master_service', 'services.id', '=', 'master_service.service_id')
            ->leftJoin('records', 'master_service.id', '=', 'records.master_service_id')
            ->groupBy('services.id', 'services.name')
            ->orderBy('record_count', 'desc')
            ->limit(5)
            ->get());

        $sheet->getStyle('A14:B' . $lastServiceRow)->applyFromArray($dataStyle);

        // Топ мастеров
        $masterStartRow = $lastServiceRow + 2;
        $sheet->getStyle('A' . $masterStartRow)->applyFromArray($sectionHeaderStyle);
        $sheet->getStyle('A' . ($masterStartRow + 1) . ':B' . ($masterStartRow + 1))->applyFromArray($tableHeaderStyle);

        // Находим последнюю строку с мастерами
        $lastMasterRow = $masterStartRow + 1 + count(Master::select(
                DB::raw("CONCAT(masters.surname, ' ', masters.name) as master_name"),
                DB::raw('COUNT(records.id) as record_count')
            )
            ->leftJoin('master_service', 'masters.id', '=', 'master_service.master_id')
            ->leftJoin('records', 'master_service.id', '=', 'records.master_service_id')
            ->groupBy('masters.id', 'masters.name', 'masters.surname')
            ->orderBy('record_count', 'desc')
            ->limit(5)
            ->get());

        $sheet->getStyle('A' . ($masterStartRow + 2) . ':B' . $lastMasterRow)->applyFromArray($dataStyle);

        // Статистика по месяцам
        $monthStartRow = $lastMasterRow + 2;
        $sheet->getStyle('A' . $monthStartRow)->applyFromArray($sectionHeaderStyle);
        $sheet->getStyle('A' . ($monthStartRow + 1) . ':B' . ($monthStartRow + 1))->applyFromArray($tableHeaderStyle);

        // Находим последнюю строку с месяцами
        $recordsByMonthCount = Record::select(
                DB::raw('MONTH(datetime) as month'),
                DB::raw('YEAR(datetime) as year'),
                DB::raw('COUNT(*) as count')
            )
            ->whereYear('datetime', date('Y'))
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get()
            ->count();

        $lastMonthRow = $monthStartRow + 1 + $recordsByMonthCount;
        $sheet->getStyle('A' . ($monthStartRow + 2) . ':B' . $lastMonthRow)->applyFromArray($dataStyle);

        // Заголовок листа
        $sheet->mergeCells('A1:B1');
        $sheet->setCellValue('A1', 'Статистика системы');

        return [];
    }
}
