<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome_page');
})->middleware('guest');
Route::get('/create_note',[App\Http\Controllers\NoteController::class,'CreateNote'])->name('create_note');
Route::post('/note_me_login',[App\Http\Controllers\General::class,'SignIn'])->name('login');
Route::post('/note_me_register',[App\Http\Controllers\General::class,'SignUp'])->name('signUp');
Route::get('/note/{id}',[App\Http\Controllers\NoteController::class,'ViewNote']);
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
Route::view('/calendar','calendar')->middleware('auth')->name('calendar');
Route::view('test','Test');
Route::view('wel','welcome_page');
Route::post('/create_note',[\App\Http\Controllers\NoteController::class,'create']);
Route::get('/note_show',function (){
   $notes=Auth()->user()->notes;

   foreach ($notes as $note)
   {

      foreach ((array)$note->content as $cc)
      {
                 $decode=json_decode($cc);
                  //[{"type":"header","data":{"text":"asdf","level":3}},{"type":"list","data":{"style":"ordered","items":["ss","dd"]}}]
                           //[{"type":"checklist","data":{"items":[{"text":"sdf","checked":true},{"text":"sdfdfd","checked":true}]}},{"type":"header","data":{"text":"sdfsdf","level":3}}]
//                 dd($decode[0]->data); //{text:'asdf',level:3}
//                 dd($decode[1]->data); //{#389 ▼
                                       //          +"style": "ordered"
                                       //      +"items": array:2 [▶] }
                 foreach ($decode as $inside)  {
                     echo $inside->type;
                     switch ($inside->type){
                         case 'header': echo 'header';break;
                         case 'list':echo 'list';break;
                     }
                     foreach($inside->data as $data)
           {

                if(is_array($data))
                {
                    foreach ($data as $datum) {
                                echo $datum,'<br>';

                    }
                }
                else{
                    echo $data,'<br>';
                }


           }
//                             dd($decode[0]->data,$decode[1]->data);

        }
      }
   }
});
require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
