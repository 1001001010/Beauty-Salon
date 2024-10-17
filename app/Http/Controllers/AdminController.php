<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\{Service, Master, User, Feedback, Record};
use Carbon\Carbon;
use App\Exports\ReportExport;
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
        $services = Service::get();
        // Получаем мастера и услуги, которые они выполняют, где видимость - 1
        $masters = Master::with('services')->where('visibility', 1)->get();

        return view('admin.index', [
            'services' => $services,
            'masters' => $masters,
        ]);
    }

    public function exel()
    {
        // Получаем данные
        $totalUsers = User::count();
        $usersThisMonth = User::whereMonth('created_at', Carbon::now()->month)->count();
        $usersThisHalfYear = User::where('created_at', '>=', Carbon::now()->subMonths(6))->count();
        $usersThisYear = User::where('created_at', '>=', Carbon::now()->subYear())->count();

        $totalFeedbacks = Feedback::count();
        $feedbacksThisMonth = Feedback::whereMonth('created_at', Carbon::now()->month)->count();
        $feedbacksThisHalfYear = Feedback::where('created_at', '>=', Carbon::now()->subMonths(6))->count();
        $feedbacksThisYear = Feedback::where('created_at', '>=', Carbon::now()->subYear())->count();

        $totalRecords = Record::count();
        $recordsThisMonth = Record::whereMonth('datetime', Carbon::now()->month)->count();
        $recordsThisHalfYear = Record::where('datetime', '>=', Carbon::now()->subMonths(6))->count();
        $recordsThisYear = Record::where('datetime', '>=', Carbon::now()->subYear())->count();
        $upcomingRecords = Record::where('datetime', '>', Carbon::now())->count();

        $totalServices = Service::count();
        $activeMasters = Master::where('visibility', 1)->count();

        // Создаем массив данных для Excel
        $data = [
            ['Пользователи'],
            ['Всего пользователей', $totalUsers],
            ['Пользователей за этот месяц', $usersThisMonth],
            ['Пользователей за полгода', $usersThisHalfYear],
            ['Пользователей за год', $usersThisYear],
            ['Отзывы'],
            ['Всего отзывов', $totalFeedbacks],
            ['Отзывов за этот месяц', $feedbacksThisMonth],
            ['Отзывов за полгода', $feedbacksThisHalfYear],
            ['Отзывов за год', $feedbacksThisYear],
            ['Записи'],
            ['Всего записей', $totalRecords],
            ['Записей за этот месяц', $recordsThisMonth],
            ['Записей за полгода', $recordsThisHalfYear],
            ['Записей за год', $recordsThisYear],
            ['Предстоящих записей', $upcomingRecords],
            ['Услуги и мастера'],
            ['Всего услуг', $totalServices],
            ['Активных мастеров', $activeMasters],
        ];

        // Генерируем Excel файл
        return Excel::download(new ReportExport($data), 'report.xlsx');
    }
}
