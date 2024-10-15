<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\{Service, Master};

class AdminController extends Controller
{
    public function index(): View {
        $services = Service::get();
        $masters = Master::with('services')->get();

        $masterServiceIds = [];
        foreach ($masters as $master) {
            foreach ($master->services as $service) {
                $masterServiceIds[] = $service->id;
            }
        }

        return view('admin.index', [
            'services' => $services,
            'masters' => $masters,
            'masterServiceIds' => $masterServiceIds
        ]);
    }
}
