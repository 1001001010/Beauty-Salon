<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    /*
    * Добавление услуги
    */
    public function upload(Request $request) {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'photo' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
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

    public function destroy(Request $request) {
        $validate = $request->validate([
            'service_id' => 'required|integer|min:1',
        ]);

        $info = Service::find($request->service_id);
        $info->delete();

        return redirect()->back();
    }

    public function update(Request $request) {
        $validate = $request->validate([
            'id' => 'required|integer|min:1',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $timestamp = time();
            $coverPath = $file->storeAs('service', $timestamp. '.'. $file->getClientOriginalExtension(), 'public');
            Service::where('id', $request->id)->update([
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'photo' => $coverPath
            ]);
        } else {
            Service::where('id', $request->id)->update([
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
            ]);
        }
        return redirect()->back();
    }
}
