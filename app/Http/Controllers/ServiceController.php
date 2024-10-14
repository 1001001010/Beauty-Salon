<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    public function upload(Request $request) {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $file = $request->file('photo');
        $timestamp = time();
        $coverPath = $file->storeAs('service', $timestamp. '.'. $file->getClientOriginalExtension(), 'public');
        Service::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'photo' => $coverPath
        ]);

        return redirect()->back();
    }
}
