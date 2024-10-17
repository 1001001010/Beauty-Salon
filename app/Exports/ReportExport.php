<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

class ReportExport implements FromArray, WithHeadings, WithStyles, ShouldAutoSize
{
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function array(): array
    {
        return $this->data;
    }

    public function headings(): array
    {
        return ['Метрика', 'Количество'];
    }

    public function styles(Worksheet $sheet)
    {
        // Объединение ячеек и форматирование
        $sheet->mergeCells('A2:B2');
        $sheet->setCellValue('A2', 'Пользователи');
        $sheet->mergeCells('A7:B7');
        $sheet->setCellValue('A7', 'Отзывы');
        $sheet->mergeCells('A12:B12');
        $sheet->setCellValue('A12', 'Записи');
        $sheet->mergeCells('A18:B18');
        $sheet->setCellValue('A18', 'Услуги и мастера');

        // Жирный шрифт для заголовков
        $sheet->getStyle('A2')->getFont()->setBold(true);
        $sheet->getStyle('A7')->getFont()->setBold(true);
        $sheet->getStyle('A12')->getFont()->setBold(true);
        $sheet->getStyle('A18')->getFont()->setBold(true);

        // Выравнивание по центру
        $sheet->getStyle('A2:B2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A7:B7')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A12:B12')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A18:B18')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Авторазмер колонок
        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
    }
}
