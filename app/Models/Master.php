<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Master extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'surname',
        'fathername',
        'photo',
        'user_id'
    ];

    public function services()
    {
        return $this->belongsToMany(Service::class, 'master_service', 'master_id', 'service_id');
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class, 'master_service_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
