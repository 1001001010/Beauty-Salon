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
        $sheet->mergeCells('A1:B1');
        $sheet->setCellValue('A1', 'Пользователи');
        $sheet->mergeCells('A6:B6');
        $sheet->setCellValue('A6', 'Отзывы');
        $sheet->mergeCells('A11:B11');
        $sheet->setCellValue('A11', 'Записи');
        $sheet->mergeCells('A17:B17');
        $sheet->setCellValue('A17', 'Услуги и мастера');

        // Жирный шрифт для заголовков
        $sheet->getStyle('A1')->getFont()->setBold(true);
        $sheet->getStyle('A6')->getFont()->setBold(true);
        $sheet->getStyle('A11')->getFont()->setBold(true);
        $sheet->getStyle('A17')->getFont()->setBold(true);

        // Выравнивание по центру
        $sheet->getStyle('A1:B1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A6:B6')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A11:B11')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A17:B17')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Авторазмер колонок
        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
    }
}
