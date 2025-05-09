<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\{Service, Master, Feedback};

class HomeController extends Controller
{
    /**
     * Отображение главной страницы
     */
    public function index(): View
    {
        $featuredFeedback = Feedback::with(['user', 'record.service'])
            ->where('rating', 5)
            ->inRandomOrder()
            ->take(3)
            ->get();

        $randomMasters = Master::with(['services'])
            ->whereHas('services')
            ->inRandomOrder()
            ->take(4)
            ->get();

        return view('index', [
            'feedback' => $featuredFeedback,
            'randomMasters' => $randomMasters
        ]);
    }
}
