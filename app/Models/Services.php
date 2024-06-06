<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    protected $table = 'wan_services';

    public function position()
    {
        return $this->hasMany(Positions::class, 'position_id');
    }

}
