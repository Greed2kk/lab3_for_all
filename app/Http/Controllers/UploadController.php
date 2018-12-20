<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use File;

class UploadController extends Controller {

    public function getForm() {
        return view('uploads_form');
    }

    public function upload(Request $request) {
        foreach ($request->file() as $file) {
            foreach ($file as $f) {
                $f->move(storage_path('app/public'), time().'_'.$f->getClientOriginalName());
            }
        }
        return redirect('uploads/all');
    }

    public function getFiles() {
        $f = Storage::disk('public');
        $files = $f->allFiles();

        return view('files', ['files' => $files]);
    }

    public function delete(Request $request) {
        $f = Storage::disk('public');
        $f->delete($request->filename);
        return redirect('uploads/all');
    }

    public function open(Request $request) {
        $f = Storage::disk('public');
        $data = json_decode($f->get($request->filename), true);
        $this->delTables();
        $this->defaultNowInf($data);
        $this->userInfo($data);
        return redirect('/users');
    }

    public function delTables() {
        DB::table('users_info')->delete(); //костыли 
        DB::table('u_answers')->delete(); //костыли 
        DB::table('stage_result')->delete(); //костыли 
        DB::table('result_all')->delete(); //костыли 
    }

    public function defaultNowInf($data) { //вот тут прям жесть происходит!     
        DB::table('now_inf')->update([
            'id' => 1,
            'now_stage' => $opertion = $data['1']['stage'],
            'que' => $opertion = $data['1']['que'],
            'opertion' => $opertion = $data['1']['opertion'],
            'checker' => 0
        ]);
    }

    public function userInfo($data) {
        $cureentUsers = count($data);
        
        for ($x = 1; $x <= $cureentUsers; $x++) {
            $user_id = $data[$x]['id'];
            $name = $data[$x]['name'];
            $stage = $data[$x]['stage'];
            $opertion = $data[$x]['opertion'];
            $que = $data[$x]['que'];

            DB::table('users_info')->insert(
                    ['user_id' => $user_id,
                        'name' => $name,
                        'stage' => $stage,
                        'opertion' => $opertion,
                        'que' => $que
            ]);
        }
    }

}
