<?php

namespace App\Exports\Sheets;

use App\Models\Record;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class RecordsSheet implements FromQuery, WithTitle, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    public function query()
    {
        return Record::query()
            ->with(['client', 'masterService.master', 'masterService.service'])
            ->orderBy('datetime', 'desc');
    }

    public function title(): string
    {
        return 'Записи';
    }

    public function headings(): array
    {
        return [
            'ID',
            'Дата и время',
            'Клиент',
            'Телефон клиента',
            'Мастер',
            'Услуга',
            'Стоимость (руб.)',
            'Дата создания'
        ];
    }

    public function map($record): array
    {
        return [
            $record->id,
            $record->datetime->format('d.m.Y H:i'),
            $record->client->name,
            $record->client->phone,
            $record->masterService->master->surname . ' ' . $record->masterService->master->name,
            $record->masterService->service->name,
            $record->masterService->service->price,
            $record->created_at->format('d.m.Y')
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Стиль для заголовков
        $headerStyle = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '5B9BD5'],
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
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
            'alignment' => [
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ];

        // Применяем стили
        $sheet->getStyle('A1:H1')->applyFromArray($headerStyle);

        // Получаем количество строк
        $rowCount = $sheet->getHighestRow();
        if ($rowCount > 1) {
            $sheet->getStyle('A2:H' . $rowCount)->applyFromArray($dataStyle);

            // Зебра (чередование цветов строк)
            for ($i = 2; $i <= $rowCount; $i++) {
                if ($i % 2 == 0) {
                    $sheet->getStyle('A' . $i . ':H' . $i)->getFill()
                        ->setFillType(Fill::FILL_SOLID)
                        ->getStartColor()->setRGB('DDEBF7');
                }
            }

            // Форматирование столбца с ценой
            $sheet->getStyle('G2:G' . $rowCount)->getNumberFormat()
                ->setFormatCode('#,##0.00 ₽');
        }

        // Добавляем заголовок над таблицей
        $sheet->insertNewRowBefore(1);
        $sheet->mergeCells('A1:H1');
        $sheet->setCellValue('A1', 'Журнал записей');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        return [];
    }
}
