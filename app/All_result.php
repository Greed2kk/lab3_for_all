<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class All_result extends Model
{
    //
    
     protected $table='result_all';
    public $primaryKey = 'id';
    public $fillable = ['result_all'];
}
