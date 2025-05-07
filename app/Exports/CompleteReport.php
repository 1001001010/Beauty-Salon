<?php

namespace App\Exports;

use App\Models\User;
use App\Models\Service;
use App\Models\Master;
use App\Models\Record;
use App\Models\Feedback;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\Exportable;
use App\Exports\Sheets\{
    UsersSheet,
    ServicesSheet,
    MastersSheet,
    RecordsSheet,
    FeedbackSheet,
    StatisticsSheet
};

class CompleteReport implements WithMultipleSheets
{
    use Exportable;

    public function sheets(): array
    {
        $sheets = [];

        $sheets[] = new UsersSheet();

        $sheets[] = new ServicesSheet();

        $sheets[] = new MastersSheet();

        $sheets[] = new RecordsSheet();

        $sheets[] = new FeedbackSheet();

        $sheets[] = new StatisticsSheet();

        return $sheets;
    }
}
