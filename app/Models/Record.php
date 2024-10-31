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

    public function masterService()
    {
        return $this->belongsTo(MasterService::class, 'master_service_id');
    }

    public function master()
    {
        return $this->hasOneThrough(Master::class, MasterService::class, 'id', 'id', 'master_service_id', 'master_id');
    }

    public function service()
    {
        return $this->hasOneThrough(Service::class, MasterService::class, 'id', 'id', 'master_service_id', 'service_id');
    }

    public function feedback()
    {
        return $this->hasOne(Feedback::class, 'records_id');
    }
}
