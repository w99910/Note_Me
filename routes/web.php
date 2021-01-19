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

Route::post('/note/create/schedules',[App\Http\Controllers\NoteController::class,'createSchedule']);
Route::post('/note/delete/schedules',[App\Http\Controllers\NoteController::class,'delete']);

Route::get('/create_note',[App\Http\Controllers\NoteController::class,'CreateNote'])->name('create_note');
Route::post('/create_note',[\App\Http\Controllers\NoteController::class,'create']);

Route::post('/note_me_login',[App\Http\Controllers\General::class,'SignIn'])->name('login');
Route::post('/note_me_register',[App\Http\Controllers\General::class,'SignUp'])->name('signUp');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/note/{id}',[App\Http\Controllers\NoteController::class,'ViewNote']);

Route::post('/user/notes',[App\Http\Controllers\NoteController::class,'notes']);
Route::view('/calendar','calendar')->middleware('auth')->name('calendar');
Route::view('wel','welcome_page');

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/upload/image',function(\Illuminate\Http\Request $req){
   Log::info($req);
});
Route::post('/upload/url',function(\Illuminate\Http\Request $req){
    Log::info($req);
});
