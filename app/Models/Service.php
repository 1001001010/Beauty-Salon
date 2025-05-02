<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'price',
        'description',
        'photo'
    ];

    public function masters()
    {
        return $this->belongsToMany(Master::class, 'master_service', 'service_id', 'master_id');
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class, 'master_service_id', 'id');
    }
}
