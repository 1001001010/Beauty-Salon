<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MasterController extends Controller
{
    public function upload(Request $request) {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'fathername' => 'required|string|max:255',
            'photo' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'services' => 'required|array|min:0',
            'services.*' => 'integer',
        ]);

    }
}
