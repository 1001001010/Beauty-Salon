<?php

namespace App\Listeners;

use App\Events\RecordCancelled;
use Illuminate\Support\Facades\Cache;

class SendCancellationNotification
{
    /**
     * Handle the event.
     *
     * @param RecordCancelled $event
     * @return void
     */
    public function handle(RecordCancelled $event)
    {
        $recipient = $event->recipient;
        $record = $event->record;
        $cancelledBy = $event->cancelledBy;

        // Формируем текст уведомления
        $message = '';

        if ($cancelledBy->role === 'client') {
            // Клиент отменил запись - уведомляем мастера
            $message = "Клиент {$cancelledBy->name} отменил запись на " .
                $record->datetime->format('d.m.Y H:i');
        } else {
            // Мастер отменил запись - уведомляем клиента
            $message = "Мастер отменил вашу запись на " .
                $record->datetime->format('d.m.Y H:i');
        }

        // Получаем текущие уведомления пользователя из кэша
        $notifications = Cache::get("user_notifications_{$recipient->id}", []);

        // Добавляем новое уведомление
        $notifications[] = [
            'id' => uniqid(),
            'message' => $message,
            'created_at' => now()->toDateTimeString(),
            'read' => false
        ];

        // Сохраняем обновленные уведомления в кэш на 30 дней
        Cache::put("user_notifications_{$recipient->id}", $notifications, now()->addDays(30));
    }
}