<?php

namespace App\Exports\Sheets;

use App\Models\User;
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

class UsersSheet implements FromQuery, WithTitle, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    public function query()
    {
        return User::query();
    }

    public function title(): string
    {
        return 'Пользователи';
    }

    public function headings(): array
    {
        return [
            'ID',
            'Имя',
            'Email',
            'Роль',
            'Провайдер',
            'Телефон',
            'Дата регистрации'
        ];
    }

    public function map($user): array
    {
        return [
            $user->id,
            $user->name,
            $user->email,
            $user->role,
            $user->provider,
            $user->phone,
            $user->created_at->format('d.m.Y H:i')
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Стиль для заголовков
        $headerStyle = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'], // Белый текст для заголовков
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
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ];

        // Стиль для данных
        $dataStyle = [
            'font' => [
                'color' => ['rgb' => '000000'], // Явно указываем черный цвет для данных
            ],
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
        $sheet->getStyle('A1:G1')->applyFromArray($headerStyle);

        // Получаем количество строк
        $rowCount = $sheet->getHighestRow();
        if ($rowCount > 1) {
            $sheet->getStyle('A2:G' . $rowCount)->applyFromArray($dataStyle);

            // Зебра (чередование цветов строк)
            for ($i = 2; $i <= $rowCount; $i++) {
                if ($i % 2 == 0) {
                    $sheet->getStyle('A' . $i . ':G' . $i)->getFill()
                        ->setFillType(Fill::FILL_SOLID)
                        ->getStartColor()->setRGB('E9EFF7');
                    // Сохраняем черный цвет текста для четных строк
                    $sheet->getStyle('A' . $i . ':G' . $i)->getFont()->getColor()->setRGB('000000');
                }
            }
        }

        // Добавляем заголовок над таблицей
        $sheet->insertNewRowBefore(1);
        $sheet->mergeCells('A1:G1');
        $sheet->setCellValue('A1', 'Список пользователей системы');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14)->getColor()->setRGB('000000');
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        return [];
    }
}
