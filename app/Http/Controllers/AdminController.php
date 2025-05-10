<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\{Service, Master, User, Feedback, Record};
use Carbon\Carbon;
use App\Exports\CompleteReport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
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

    public function excel()
    {
        return Excel::download(new CompleteReport, 'complete-report.xlsx');
    }

    public function pdf(Request $request)
    {
        // Получаем записи с необходимыми отношениями
        $records = Record::with([
            'client',
            'masterService.master',
            'masterService.service'
        ])
        ->orderBy('datetime', 'desc')
        ->get();

        // Формируем данные для отчета
        $data = [
            'title' => 'Отчет по записям',
            'date' => date('d.m.Y'),
            'records' => $records
        ];

        // Генерируем PDF
        $pdf = PDF::loadView('reports.records', $data);

        // Возвращаем PDF для скачивания
        return $pdf->download('records_report_'.date('Y-m-d').'.pdf');
    }
}
