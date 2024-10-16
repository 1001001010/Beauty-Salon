<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\{Service, Master};

class AdminController extends Controller
{
    /*
    * Отображение панель администратора
    */
    public function index(): View {
        $services = Service::get();
        $masters = Master::with('services')->get();

        return view('admin.index', [
            'services' => $services,
            'masters' => $masters,
        ]);
    }
}
