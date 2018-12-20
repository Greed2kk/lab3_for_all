<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!

  Route::get('/', function () {
  return view('welcome');
  });
 */
//Загрузка файла
Route::get('/uploads', ['as' => 'uploads_form', 'uses' => 'UploadController@getForm']);
Route::post('uploads', ['as' => 'uploads_file', 'uses' => 'UploadController@upload']);
//просмотр файлов, удаление, открытие
Route::get('uploads/all', ['as' => 'uploads_all', 'uses' => 'UploadController@getFiles']);
Route::get('uploads/delete/{filename}', ['as' => 'uploads_delete', 'uses' => 'UploadController@delete']);
Route::get('uploads/open/{filename}', ['as' => 'uploads_open', 'uses' => 'UploadController@open']);

//пользователи
Route::get('/users', ['as' => 'users', 'uses' => 'Users@users']);
//выбор пользователя
/*
Route::get('/user/{user_name}', [
    'as' => 'user', 'uses' => 'Users@stage_sel'
]);
*/

Route::get('/user/{user_name}', [
    'as' => 'user', 'uses' => 'Users@currentUser'
]); 
//запись выбора в бд
Route::post('add', 'Users@add')->name('add');


//вывод информации
Route::get('output', 'Output@info')->name('info');
//скачка ебаная
Route::get('download-jsonfile', array('as'=> 'file.download', 'uses' => 'Output@downloadJSONFile'));
Route::get('download-jsonfile-1', array('as'=> 'file.download', 'uses' => 'Output@downloadJSONFile1'));