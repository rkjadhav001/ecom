<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Youtube extends Model
{
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

}
