<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Получить уведомления для текущего пользователя
     */
    public function getNotifications()
    {
        $userId = Auth::id();
        $notifications = Cache::get("user_notifications_{$userId}", []);

        return response()->json([
            'success' => true,
            'notifications' => $notifications,
            'unread_count' => collect($notifications)->where('read', false)->count()
        ]);
    }

    /**
     * Отметить уведомление как прочитанное
     */
    public function markAsRead(Request $request)
    {
        $userId = Auth::id();
        $notificationId = $request->notification_id;

        $notifications = Cache::get("user_notifications_{$userId}", []);

        foreach ($notifications as $key => $notification) {
            if ($notification['id'] === $notificationId) {
                $notifications[$key]['read'] = true;
                break;
            }
        }

        Cache::put("user_notifications_{$userId}", $notifications, now()->addDays(30));

        return response()->json([
            'success' => true,
            'unread_count' => collect($notifications)->where('read', false)->count()
        ]);
    }

    /**
     * Отметить все уведомления как прочитанные
     */
    public function markAllAsRead()
    {
        $userId = Auth::id();
        $notifications = Cache::get("user_notifications_{$userId}", []);

        foreach ($notifications as $key => $notification) {
            $notifications[$key]['read'] = true;
        }

        Cache::put("user_notifications_{$userId}", $notifications, now()->addDays(30));

        return response()->json([
            'success' => true,
            'unread_count' => 0
        ]);
    }
}
