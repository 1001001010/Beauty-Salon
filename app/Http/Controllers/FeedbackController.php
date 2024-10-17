<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use Auth;

class FeedbackController extends Controller
{
    public function index($sort) {
        $feedback = Feedback::with('user')
            ->orderBy('created_at', $sort)
            ->get();

        return view('feedback.index', [
            'feedback' => $feedback,
        ]);
    }

    public function upload(Request $request) {
        $validate = $request->validate([
            'records_id' => 'required|integer|min:1',
            'description' => 'required|string',
            'photo' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);
        // Получаем и сохраняем файл
        $file = $request->file('photo');
        $timestamp = time();
        $coverPath = $file->storeAs('feedback', $timestamp. '.'. $file->getClientOriginalExtension(), 'public');
        // Сохраняем
        Feedback::create([
            'user_id' => Auth::id(),
            'records_id' => $request->records_id,
            'comment' => $request->description,
            'photo' => $coverPath
        ]);

        return redirect()->back()->with('message', ['type' => 'message', 'text' => 'Отзыв успешно опубликован!']);
    }

    public function destroy(Request $request) {
        $validate = $request->validate([
            'feedback_id' => 'required|integer|min:1'
        ]);

        // Находим отзыв по ID
        $info = Feedback::find($request->feedback_id);
        //Если найден, то удаляем, если нет, выводим ошибку
        if($info) {
            $info->delete();
            return redirect()->back()->with('message', ['type' => 'message', 'text' => 'Отзыв успешно удален!']);
        } else {
            return redirect()->back()->with('message', ['type' => 'error', 'text' => 'Ошибка удаления отзыва!']);
        }
    }
}
