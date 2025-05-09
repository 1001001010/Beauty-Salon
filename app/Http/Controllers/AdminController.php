<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\{Service, Master, User, Feedback, Record};
use Carbon\Carbon;
use App\Exports\CompleteReport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;

class AdminController extends Controller
{
    /*
    * Отображение панель администратора
    */
    public function index(): View {
        $services = Service::withTrashed()->get();
        $masters = Master::withTrashed()->with('services')->get();

        // Подсчёт записей за текущий месяц
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
        $recordsCount = Record::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();

        return view('admin.index', [
            'services' => $services,
            'masters' => $masters,
            'recordsCount' => $recordsCount,
        ]);
    }

    public function exel()
    {
        return Excel::download(new CompleteReport, 'complete-report.xlsx');
    }
}
