<?php

namespace App\Events;

use App\Models\Record;
use App\Models\User;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RecordCancelled
{
    use Dispatchable, SerializesModels;

    public $record;
    public $cancelledBy;
    public $recipient;

    /**
     * Create a new event instance.
     *
     * @param Record $record Отмененная запись
     * @param User $cancelledBy Пользователь, отменивший запись
     * @param User $recipient Получатель уведомления
     */
    public function __construct(Record $record, User $cancelledBy, User $recipient)
    {
        $this->record = $record;
        $this->cancelledBy = $cancelledBy;
        $this->recipient = $recipient;
    }
}
