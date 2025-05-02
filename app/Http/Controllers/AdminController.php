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
        $services = Service::get(); // Получаем все услуги
        $masters = Master::with('services')->get(); // Получаем мастеров

        return view('admin.index', [
            'services' => $services,
            'masters' => $masters,
        ]);
    }

    public function exel()
    {
        // Получаем данные
        $totalUsers = User::count() ?: '0';
        $usersThisMonth = User::whereMonth('created_at', Carbon::now()->month)->count() ?: '0';
        $usersThisHalfYear = User::where('created_at', '>=', Carbon::now()->subMonths(6))->count() ?: '0';
        $usersThisYear = User::where('created_at', '>=', Carbon::now()->subYear())->count() ?: '0';

        $totalFeedbacks = Feedback::count() ?: '0';
        $feedbacksThisMonth = Feedback::whereMonth('created_at', Carbon::now()->month)->count() ?: '0';
        $feedbacksThisHalfYear = Feedback::where('created_at', '>=', Carbon::now()->subMonths(6))->count() ?: '0';
        $feedbacksThisYear = Feedback::where('created_at', '>=', Carbon::now()->subYear())->count() ?: '0';

        $totalRecords = Record::count() ?: '0';
        $recordsThisMonth = Record::whereMonth('datetime', Carbon::now()->month)->count() ?: '0';
        $recordsThisHalfYear = Record::where('datetime', '>=', Carbon::now()->subMonths(6))->count() ?: '0';
        $recordsThisYear = Record::where('datetime', '>=', Carbon::now()->subYear())->count() ?: '0';
        $upcomingRecords = Record::where('datetime', '>', Carbon::now())->count() ?: '0';

        $totalServices = Service::count() ?: '0';
        $activeMasters = Master::where('visibility', 1)->count() ?: '0';

        // Создаем массив данных для Excel
        $data = [
            [' '],
            ['Всего пользователей', $totalUsers],
            ['Пользователей за этот месяц', $usersThisMonth],
            ['Пользователей за полгода', $usersThisHalfYear],
            ['Пользователей за год', $usersThisYear],
            [' '],
            ['Всего отзывов', $totalFeedbacks],
            ['Отзывов за этот месяц', $feedbacksThisMonth],
            ['Отзывов за полгода', $feedbacksThisHalfYear],
            ['Отзывов за год', $feedbacksThisYear],
            [' '],
            ['Всего записей', $totalRecords],
            ['Записей за этот месяц', $recordsThisMonth],
            ['Записей за полгода', $recordsThisHalfYear],
            ['Записей за год', $recordsThisYear],
            ['Предстоящих записей', $upcomingRecords],
            [' '],
            ['Всего услуг', $totalServices],
            ['Активных мастеров', $activeMasters],
        ];

        // Генерируем Excel файл
        return Excel::download(new ReportExport($data), 'report.xlsx');
    }
}
