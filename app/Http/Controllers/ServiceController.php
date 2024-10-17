<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Service, Master};

class ServiceController extends Controller
{
    /*
    * Добавление услуги
    */
    public function index() {
        return view('services.index', [
            'services' => Service::with('masters')->get(),
            'masters' => Master::get()
        ]);
    }

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

        // Получаем фото и сохраняем его
        $file = $request->file('photo');
        $timestamp = time();
        $coverPath = $file->storeAs('service', $timestamp. '.'. $file->getClientOriginalExtension(), 'public');
        // Добавляем услугу в бд
        Service::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'photo' => $coverPath
        ]);

        return redirect()->back()->with('message', ['type' => 'message', 'text' => 'Услуга успешно добавлена!']);
    }

    /*
    * Удаление услуги
    */
    public function destroy(Request $request) {
        $validate = $request->validate([
            'service_id' => 'required|integer|min:1',
        ]);

        // Находим услугу и удаляем
        $info = Service::find($request->service_id);
        $info->delete();

        return redirect()->back()->with('message', ['type' => 'message', 'text' => 'Услуга успешно удалена!']);
    }

    /*
    * Редактирование услуги
    */
    public function update(Request $request) {
        $validate = $request->validate([
            'id' => 'required|integer|min:1',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Если загружено фото, то сохраняем его и редактируем запись
        if ($request->hasFile('photo')) {
            // Сохраняем фото
            $file = $request->file('photo');
            $timestamp = time();
            $coverPath = $file->storeAs('service', $timestamp. '.'. $file->getClientOriginalExtension(), 'public');
            // Редактируем запись в таблице
            Service::where('id', $request->id)->update([
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'photo' => $coverPath
            ]);
        } else {
            // Редактируем запись, если нет фото
            Service::where('id', $request->id)->update([
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
            ]);
        }
        return redirect()->back()->with('message', ['type' => 'message', 'text' => 'Услуга успешно изменена!']);
    }
}
