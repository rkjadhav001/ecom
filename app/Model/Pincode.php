<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Pincode extends Model
{
    protected $casts = [
        'published'  => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

}
