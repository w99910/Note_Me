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
if(env('APP_ENV')==='production'){
    \Illuminate\Support\Facades\URL::forceScheme('https');
}
Route::get('/get/locale',function(){
   \Illuminate\Support\Facades\App::setLocale('mm');
   $data=resource_path();
//   echo __('messages.login');
    dd($data);
});
Route::post('/set/locale',[App\Http\Controllers\General::class,'changeLocale']);
Route::get('/dashboard',[App\Http\Controllers\NoteController::class,'index'])->middleware('auth')->name('dashboard');

Route::post('/note/create/schedules',[App\Http\Controllers\NoteController::class,'createSchedule']);
Route::post('/note/delete/schedules',[App\Http\Controllers\NoteController::class,'delete']);

Route::get('/create_note',[App\Http\Controllers\NoteController::class,'CreateNote'])->name('create_note');
Route::post('/create_note',[App\Http\Controllers\NoteController::class,'create']);
Route::post('/delete/note',[App\Http\Controllers\NoteController::class,'delete']);
Route::post('/note_me_login',[App\Http\Controllers\General::class,'SignIn'])->name('custom_login');
Route::post('/note_me_register',[App\Http\Controllers\General::class,'SignUp'])->name('custom_signUp');

Route::get('/note/{id}',[App\Http\Controllers\NoteController::class,'ViewNote']);

Route::post('/user/notes',[App\Http\Controllers\NoteController::class,'notes']);
Route::post('/schedules',[App\Http\Controllers\NoteController::class,'schedules']);
Route::post('/trash',[App\Http\Controllers\NoteController::class,'trash']);
Route::post('/trash/restore',[App\Http\Controllers\NoteController::class,'Restore']);
Route::post('/trash/delete',[App\Http\Controllers\NoteController::class,'deleteTrash']);
Route::post('/delete/all',[App\Http\Controllers\NoteController::class,'deleteAll']);

Route::view('/calendar','calendar')->middleware('auth')->name('calendar');
Route::view('wel','welcome_page');
Route::get('/', function () {
    $locale=Illuminate\Support\Facades\App::getLocale();
    $localization=[
        'login'=>__('messages.login'),
        'signup'=>__('messages.sign-up'),
        'about'=>__('messages.about'),
    ];
   return view('welcome_page',compact('locale','localization'));
})->middleware('guest');


require __DIR__.'/auth.php';

Auth::routes();


Route::post('/upload/image',function(\Illuminate\Http\Request $req){
   Log::info($req);
});
Route::post('/upload/url',function(\Illuminate\Http\Request $req){
    Log::info($req);
});
