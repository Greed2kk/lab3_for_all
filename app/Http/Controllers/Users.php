<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Users_info;

class Users extends Controller {
    //
    public function users() {
        $users_info = DB::table('users_info')->get();
        
        $stage= DB::table('users_info')->distinct()->select('stage')->get()->count();   
        $users_count = DB::table('users_info')->select('name')->groupBy('name')->get()->count();

        $users_name=DB::table('users_info')->select('name')->orderBy('stage', 'asc')->groupBy('name')->get();
        $curent_user_stage_que = DB::table('users_info')->select('stage')->where('que','=', 0)->min('stage'); //какой сейчас этап по списку
        //dd($users_name);
        $data = [
            'users' => $users_count,
            'total_stage' => $stage,
            'current_stage' => $curent_user_stage_que,
            'users_name' => $users_name
                //'u_answers' => $u_answers
        ];
        
         
       
     
       
       
        return view('users', $data);
    }
 

    public function currentUser($user_name, Request $request) {
        $now_inf = DB::table('now_inf')->first();
        $current_stage = $now_inf->now_stage;
        $curent_user_stage_que = DB::table('users_info')->select('stage')->where('que','=', 0)->min('stage'); //какой сейчас этап по списку
        $cur_user=$user_name; //имя пользователя
        $curent_user_stage_now = DB::table('users_info')->select('stage')->where('name', '=', $cur_user)->where('que','!=', 1)->min('stage'); //- этап текущего юзера   
        //dd($first_stage );
        
        
        return view('currentUser', ['user_name' => $user_name, 'current_stage' => $current_stage, 'curent_user_stage'=>$curent_user_stage_que, 'curent_user_stage_now'=>$curent_user_stage_now]);
    }


    public function add(Request $request) {
        $user_name= request()->input('user_name'); //имя пользователя
        $curent_user_stage_now = request()->input('curent_user_stage_now'); // этап пользователя сейчас
        $curent_user_stage = request()->input('cur_user_stage'); //какой сейчас этап по списку
        $choice = request()->input('choice');
        
        
            
       DB::table('users_info')->where('name','=', $user_name)->where('stage', '=', $curent_user_stage_now ) ->update(
                        ['que' => 1 ]);
          
        
        $opertion = DB::table('users_info')->select('opertion')->where('name', '=', $user_name)->where('stage', '=', $curent_user_stage_now)->first();
        
        //dd($opertion);
        DB::table('u_answers')->insert(
                [
                    'stage' => $curent_user_stage_now,
                    'answer' => $choice,
                    'user_name' => $user_name,
                    'opertion' => $opertion->opertion
        ]);
    
        
        return redirect('/users');
    }

}
