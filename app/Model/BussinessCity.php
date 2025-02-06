<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BussinessCity extends Model
{
    protected $casts = [
        'city_id'  => 'string',
        'city_name' => 'string',
        'city_state' => 'string',
    ];

    protected $table = 'cities';

}
