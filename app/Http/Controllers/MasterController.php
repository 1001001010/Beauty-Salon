<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Master, User, Record};
use Auth;
use Illuminate\Validation\Rules;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class MasterController extends Controller
{

    public function index() {
        $currentDateTime = Carbon::now();
        $records = Record::with('client', 'master', 'service')
        ->where('datetime', '>', $currentDateTime)
        ->whereHas('master', function ($query) {
            $query->whereHas('user', function ($query) {
                $query->where('users.id', Auth::id());
            });
        })->orderBy('datetime', 'asc')
        ->get();
        return view('master.index', [
            'records' => $records
        ]);
    }
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
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()]
        ]);

        // регистрация аккаунта нового мастера
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'master',
        ]);

        event(new Registered($user));

        // Получаем и сохраняем фото
        $file = $request->file('photo');
        $timestamp = time();
        $photoPath = $file->storeAs('service', $timestamp. '.'. $file->getClientOriginalExtension(), 'public');

        $master = Master::create([
            'user_id' => $user->id,
            'name' => $validate['name'],
            'surname' => $validate['surname'],
            'fathername' => $validate['fathername'],
            'photo' => $photoPath,
        ]);

        // Связывание мастера с услугами
        $services = $validate['services'];
        $master->services()->attach($services);

        return redirect()->back()->with('message', ['type' => 'message', 'text' => 'Мастер успешно добавлен!']);
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
            return redirect()->back()->with('message', ['type' => 'error', 'text' => 'Мастер не найден']);
        }
        $master->update([
            'visibility' => 0
        ]);

        return redirect()->back()->with('message', ['type' => 'message', 'text' => 'Мастер успешно удален']);
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

        // Находим мастера по ID
        $master = Master::findOrFail($request->id);

        //Если есть фото, то сохраняем и обновляем
        if ($request->hasFile('photo')) {
            // Сохраняем файл
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

        return redirect()->back()->with('message', ['type' => 'message', 'text' => 'Информация о мастере успешно изменена!']);
    }
}
