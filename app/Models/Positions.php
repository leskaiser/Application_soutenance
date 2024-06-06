<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Positions extends Model
{
    protected $table = 'wan_positions';

    public function service()
    {
        return $this->belongsTo(Services::class);
    }

    public function user()
    {
        return $this->hasMany(User::class, 'position_id');
    }
}
