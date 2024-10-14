<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Master extends Model
{
    use HasFactory;

    public function services()
    {
        return $this->belongsToMany(Service::class, 'master_service', 'master_id', 'service_id');
    }
}
