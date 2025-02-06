<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Bussiness extends Model
{
    protected $table = 'bussinesses';
    protected $fillable = ['name','country','state','city','address','longitude','latitude','mobile','whatsapp_number','bussiness_description','selfie_image','employee_id','interest','feedback','pincode','selfiee_latitude','selfiee_longitude','shop_image','created_at','deleted_at','updated_at'];
}
