<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedbacks';
    protected $fillable = ['business_id','business_name','interest','feedback','created_at','deleted_at','updated_at','business_image','employee_id','employee_name'];
}
