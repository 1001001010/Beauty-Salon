<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MasterUploadRequest;
use App\Models\{Master, User, Record};
use Auth;
use Carbon\Carbon;

class MasterController extends Controller
{

    public function index()
    {
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

    /**
     * Добавление мастера
     */
    public function upload(MasterUploadRequest $request)
    {
        $validate = $request->validated();

        // Получаем существующего пользователя
        $user = User::findOrFail($validate['user_id']);

        // Проверяем, не является ли пользователь уже мастером
        if (Master::where('user_id', $user->id)->exists()) {
            return redirect()->back()->withErrors(['user_id' => 'Этот пользователь уже является мастером'])->withInput();
        }

        // Обновляем роль пользователя, если она не установлена как 'master'
        if ($user->role !== 'master') {
            $user->update(['role' => 'master']);
        }

        // Получаем и сохраняем фото
        $file = $request->file('photo');
        $timestamp = time();
        $photoPath = $file->storeAs('service', $timestamp . '.' . $file->getClientOriginalExtension(), 'public');

        // Создаем запись мастера
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
     * Удаление мастера
     */
    public function delete(Master $master)
    {
        // Проверяем наличие предстоящих записей
        $currentDateTime = Carbon::now();
        $hasUpcomingRecords = Record::where('datetime', '>', $currentDateTime)
            ->whereHas('master', function ($query) use ($master) {
                $query->where('masters.id', $master->id);
            })
            ->exists();

        // Если есть предстоящие записи, возвращаем ошибку
        if ($hasUpcomingRecords) {
            return redirect()->back()->with('message', [
                'type' => 'error',
                'text' => 'Невозможно удалить мастера, так как на него есть предстоящие записи!'
            ]);
        }

        // Если предстоящих записей нет, удаляем мастера
        $user = $master->user;
        if ($user) {
            $user->role = 'user';
            $user->save();
        }

        $master->delete();

        return redirect()->back()->with('message', ['type' => 'message', 'text' => 'Мастер успешно удален']);
    }

    /*
     * Восстановление мастера
     */
    public function restore(Master $master)
    {
        $user = $master->user;
        if ($user) {
            $user->role = 'master';
            $user->save();
        }

        $master->restore();

        return redirect()->back()->with('message', ['type' => 'message', 'text' => 'Мастер успешно восстановлен']);
    }


    /*
     * Редактирование услуги
     */
    public function update(Request $request)
    {
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
            $coverPath = $file->storeAs('service', $timestamp . '.' . $file->getClientOriginalExtension(), 'public');

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

    public function search(Request $request)
    {
        $query = $request->input('q');

        if (empty($query) || strlen($query) < 2) {
            return response()->json([]);
        }

        $users = User::where('email', 'like', "%{$query}%")
            ->orWhere('name', 'like', "%{$query}%")
            ->with('master.services')
            ->limit(10)
            ->get(['id', 'name', 'email']);

        return response()->json($users);
    }
}