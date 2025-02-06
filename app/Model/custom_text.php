<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class custom_text extends Model
{
    protected $primaryKey='custom_text_id';
    protected $table='custom_text';
    public $timestamps=false;
    protected $fillable=['custom_text_label','custom_text_label2'];
}
