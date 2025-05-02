<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Атрибуты, которые можно массово назначить
    protected $fillable = [
        'name',
        'role',
        'phone',
        'email',
        'password',
    ];

    // Данные, скрытые для сериализации
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Приведение к определнному типу
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    // Связь с таблицей отзывов
    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }

    // Связь с таблицей записей
    public function records()
    {
        return $this->hasMany(Record::class, 'client_id');
    }

    // Связь с таблицей мастеров
    public function master()
    {
        return $this->hasOne(Master::class);
    }
}
