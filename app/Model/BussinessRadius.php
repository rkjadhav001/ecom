<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BussinessRadius extends Model
{
  
    protected $table = 'bussiness_radius';
    protected $fillable = ['radius', 'created_at','updated_at'];

}
