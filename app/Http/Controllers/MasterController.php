<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Master;

class MasterController extends Controller
{
    /*
    * Добавление мастера
    */
    public function upload(Request $request) {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'fathername' => 'required|string|max:255',
            'photo' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'services' => 'required|array|min:0',
            'services.*' => 'integer',
        ]);

        $file = $request->file('photo');
        $timestamp = time();
        $photoPath = $file->storeAs('service', $timestamp. '.'. $file->getClientOriginalExtension(), 'public');

        $master = Master::create([
            'name' => $validate['name'],
            'surname' => $validate['surname'],
            'fathername' => $validate['fathername'],
            'photo' => $photoPath,
        ]);

        // Связывание мастера с услугами
        $services = $validate['services'];
        $master->services()->attach($services);

        return redirect()->back();
    }

    /*
    * Удаление услуги
    */
    public function destroy(Request $request) {
        $validate = $request->validate([
            'master_id' => 'required|integer|min:1',
        ]);

        $masterId = $request->input('master_id');
        $master = Master::find($masterId);
        if (!$master) {
            return redirect()->back()->with('error', 'Мастер не найден');
        }
        $master->delete();

        return redirect()->back()->with('success', 'Мастер успешно удален');
    }

    /*
    * Редактирование услуги
    */
    public function update(Request $request) {
        $validate = $request->validate([
            'id' => 'required|integer|min:1',
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'fathername' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'services' => 'nullable|array|min:0',
            'services.*' => 'integer',
        ]);

        $master = Master::findOrFail($request->id);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $timestamp = time();
            $coverPath = $file->storeAs('service', $timestamp. '.'. $file->getClientOriginalExtension(), 'public');
            $master->update([
                'name' => $request->name,
                'surname' => $request->surname,
                'fathername' => $request->fathername,
                'photo' => $coverPath
            ]);
        } else {
            $master->update([
                'name' => $request->name,
                'surname' => $request->surname,
                'fathername' => $request->fathername,
            ]);
        }

        $services = $validate['services'];
        $master->services()->sync($services);

        return redirect()->back();
    }
}
