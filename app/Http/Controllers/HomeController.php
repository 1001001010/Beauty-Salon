<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\{Service, Master};

class HomeController extends Controller
{
    /**
     * Отображение главной страницы
     */
    public function index(): View {
        return view('index');
    }

    /**
     * Отображение результатов поиска по ключевому слову
     */
    public function search(Request $request): View {
        $validate = $request->validate([
            'word' => 'required|string|max:255',
        ]);

        $word = $request->input('word');
        // Поиск по названию и описанию по ключевым словам
        $services = Service::with('masters')
            ->where('name', 'like', '%' . $word . '%')
            ->orWhere('description', 'like', '%' . $word . '%')
            ->get();

        return view('services.index', [
            'services' => $services,
            'masters' => Master::get()
        ]);
    }
}
