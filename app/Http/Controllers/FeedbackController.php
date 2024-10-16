<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use Auth;

class FeedbackController extends Controller
{
    public function upload(Request $request) {
        $validate = $request->validate([
            'records_id' => 'required|integer|min:1',
            'description' => 'required|string',
            'photo' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $file = $request->file('photo');
        $timestamp = time();
        $coverPath = $file->storeAs('feedback', $timestamp. '.'. $file->getClientOriginalExtension(), 'public');
        Feedback::create([
            'user_id' => Auth::id(),
            'records_id' => $request->records_id,
            'comment' => $request->description,
            'photo' => $coverPath
        ]);

        return redirect()->back()->with('message', ['type' => 'message', 'text' => 'Комментарий успешно опубликован!']);
    }
}
