<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Service, Master, Record, MasterService};

class ServiceController extends Controller
{
    /*
    * Добавление услуги
    */
    public function index(Request $request)
    {
        $query = Service::query()->with('masters');

        // Фильтрация по названию
        if ($request->has('word') && !empty($request->word)) {
            $query->where('name', 'like', '%' . $request->word . '%');
        }

        // Фильтрация по цене
        if ($request->has('price_min') && is_numeric($request->price_min)) {
            $query->where('price', '>=', $request->price_min);
        }
        if ($request->has('price_max') && is_numeric($request->price_max)) {
            $query->where('price', '<=', $request->price_max);
        }

        // Сортировка
        $sort = $request->get('sort', 'name'); // По умолчанию сортировка по названию
        $direction = $request->get('direction', 'asc'); // По умолчанию по возрастанию

        $query->orderBy($sort, $direction);

        $services = $query->paginate(10);

        return view('services.index', [
            'services' => $services,
            'masters' => Master::all()
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

    /**
     * Удаление услуги и связанных предстоящих записей
     */
    public function delete(Service $service)
    {
        // Удаляем все будущие записи, связанные с этой услугой
        Record::whereHas('masterService', function($query) use ($service) {
                $query->where('service_id', $service->id);
            })
            ->where('datetime', '>', now())
            ->delete();

        // Удаляем саму услугу
        $service->delete();

        return redirect()
            ->back()
            ->with('message', [
                'type' => 'message',
                'text' => 'Услуга и все связанные предстоящие записи успешно удалены!'
            ]);
    }

    /*
    * Восстановление услуги
    */
    public function restore(Service $service) {
        $service->restore();
        return redirect()->back()->with('message', ['type' => 'message', 'text' => 'Услуга успешно восстановлена!']);
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
