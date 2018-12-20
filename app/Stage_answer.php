<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stage_answer extends Model
{
    //
    
     protected $table='stage_result';
    public $primaryKey = 'id';
    public $fillable = ['stage', 'anwser'];
}
