<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Support\Jsonable;
use App\U_answers;
use App\All_result;
use App\Stage_answer;
use File;
class Output extends Controller
{
    //функция аутпута и вывода
    public function info() { 
        
        $total_inf = DB::table('u_answers')->simplePaginate(300);

       $stage_inf= DB::table('u_answers')->get();  
       $count=DB::table('u_answers')->count();
        for ($i=0; $i<$count; ++$i)
       {
          if ($stage_inf[$i]->opertion == 0) 
          {
          DB::table('stage_result')->insert(
                [
                    'stage' => $stage_inf[$i]->stage,
                    'answer' => $stage_inf[$i]->answer,
                    ]); 
          }  
          elseif ($stage_inf[$i]->opertion == 2)
          {
              if ($stage_inf[$i]->answer==1)
              {
                  DB::table('stage_result')->insert(
                [
                    'stage' => $stage_inf[$i]->stage,
                    'answer' => $stage_inf[$i]->answer]);
                      $i++;
              }
              elseif ($stage_inf[$i]->answer == 0)
              {
                   DB::table('stage_result')->insert(
                [
                    'stage' => $stage_inf[$i]->stage,
                    'answer' => $stage_inf[$i]->answer]);
                   $i++;
              }    
          }
          elseif ($stage_inf[$i]->opertion == 1) 
          {
              if ($stage_inf[$i]->answer==1)
              {
                  DB::table('stage_result')->insert(
                [
                    'stage' => $stage_inf[$i]->stage,
                    'answer' => $stage_inf[$i]->answer]);
                   $i++;
              }
              elseif ($stage_inf[$i]->answer==0)
              {
                  DB::table('stage_result')->insert(
                [
                  'stage' => $stage_inf[$i+1]->stage,
                  'answer' => $stage_inf[$i+1]->answer]);
                   $i++;
              }
          }
          
       } 
       $stage_res = DB::table('stage_result')->simplePaginate(300);
       
       $stage_res_res_d=DB::table('stage_result')->get();
       $stage_res_res=DB::table('stage_result')->select('answer')->first();
       $stage_res_res=$stage_res_res->answer;
       foreach ($stage_res_res_d as $stage_res_res_ds)  
       {
           $stage_res_res=($stage_res_res_ds->answer)*($stage_res_res);
       }
    $all_stage_res=$stage_res_res;
    
    if($all_stage_res == 1)
    {
        $all_stage_res='Документ одобрен';
    }
    else $all_stage_res='Документ не одобрен';

     DB::table('result_all')->insert(
                [
                  'result_all' => $all_stage_res]);
    
   /////////////////////////////////////////////////////////////////////////  
 
   //$collection=U_answers::select('stage','user_name', 'answer')->orderBy('stage', 'desc')->get();
//$unique = $collection->unique('user_name');
//$unique->values()->all();

     
     $users_name=DB::table('u_answers')->select('user_name')->orderBy('stage', 'desc')->groupBy('user_name')->get();
     //dd($users_name);
     
     //dd($unique->toArray());
     
///////////////////////////////////////////////////////////////////////////////     
    
      //сделать запрос по уникальным юзер-неймам, и взять этап максимум и сделать сортировку по убыванию.
        return view('output', ['total_inf' => $total_inf, 'stage_inf'=> $stage_inf, 'stage_res'=>$stage_res, 'stage_res_res'=>$all_stage_res]); 
    }
    //сохранение и скачивание файла
    public function downloadJSONFile(){
      $data_merge = new \Illuminate\Database\Eloquent\Collection; 
      $data = U_answers::all();
      $data_result=All_result::select('result_all')->get();
      $data_merge=$data_merge->merge($data);
      $data_merge=$data_merge->merge($data_result);
      $data = json_encode($data_merge, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
      $file = time().'_'.'output_file.json';
      $destinationPath=public_path()."/upload/json/";
      if (!is_dir($destinationPath)) {  mkdir($destinationPath,0777,true);  }
      File::put($destinationPath.$file,$data);
      return response()->download($destinationPath.$file);
    }
    public function downloadJSONFile1(){
      $data_merge = new \Illuminate\Database\Eloquent\Collection; 
      $data = Stage_answer::all();
      $data_result=All_result::select('result_all')->get();
      $data_merge=$data_merge->merge($data);
      $data_merge=$data_merge->merge($data_result);
      $data = json_encode($data_merge, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
      $file = time().'_'.'output_file.json';
      $destinationPath=public_path()."/upload/json/";
      if (!is_dir($destinationPath)) {  mkdir($destinationPath,0777,true);  }
      File::put($destinationPath.$file,$data);
      return response()->download($destinationPath.$file);
    }
    
}
