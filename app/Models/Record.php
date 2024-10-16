<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'master_service_id',
        'datetime',
        'status'
    ];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function master()
    {
        return $this->belongsTo(Master::class, 'master_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
