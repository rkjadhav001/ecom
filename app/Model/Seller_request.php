<?php

namespace App\Model;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Seller_request extends Model
{
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class,'user_id');
    }

}
