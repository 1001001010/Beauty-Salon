<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Отображение главной страницы
     */
    public function index(): View {
        return view('index');
    }
}
