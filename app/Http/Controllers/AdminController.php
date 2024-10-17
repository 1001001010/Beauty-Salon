<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\{Service, Master, User, Feedback, Record};
use Carbon\Carbon;
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
        $totalFeedbacks = Feedback::count();
        $totalRecords = Record::count();
        $upcomingRecords = Record::where('datetime', '>', Carbon::now())->count();
        $totalServices = Service::count();

        // Создаем массив данных для Excel
        $data = [
            ['Метрика', 'Количество'],
            ['Всего пользователей', $totalUsers],
            ['Пользователей за этот месяц', $usersThisMonth],
            ['Всего отзывов', $totalFeedbacks],
            ['Всего записей', $totalRecords],
            ['Предстоящих записей', $upcomingRecords],
            ['Всего услуг', $totalServices],
        ];

        // Генерируем Excel файл
        return Excel::download(new class($data) implements FromArray {
            private $data;

            public function __construct(array $data)
            {
                $this->data = $data;
            }

            public function array(): array
            {
                return $this->data;
            }
        }, 'report.xlsx');
    }
}
