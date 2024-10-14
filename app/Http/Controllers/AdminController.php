<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Service;

class AdminController extends Controller
{
    public function index(): View {
        return view('admin.index', [
            'services' => Service::get(),
        ]);
    }
}
