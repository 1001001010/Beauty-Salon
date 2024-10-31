<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterService extends Model
{
    protected $table = 'master_service';

    protected $fillable = [
        'master_id',
        'service_id',
    ];

    public function master()
    {
        return $this->belongsTo(Master::class, 'master_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
