<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
 
class Users_info extends Model
{
    //
    protected $table='users_info';
    public $primaryKey = 'id';
    public $fillable = ['user_id','name', 'stage', 'opertion', 'que'];
 
}
