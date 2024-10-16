<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'master_service_id', 'comment'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function record()
    {
        return $this->belongsTo(Record::class, 'records_id');
    }
}
