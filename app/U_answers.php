<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class U_answers extends Model
{
    //
    
     protected $table='u_answers';
    public $primaryKey = 'id';
    public $fillable = ['user_n','stage', 'user_name', 'anwser', 'opertion'];
}
