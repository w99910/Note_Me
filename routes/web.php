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
          $file=__('messages');
    dd($file);
});
Route::get('/mailable', function () {
    \Illuminate\Support\Facades\Mail::to('testlesson2019@gmail.com')->send(new App\Mail\SupportMail('zaw','lin','zaw@mail','content'));
//    return new App\Mail\SupportMail('zaw','lin','zaw@mail','content');
});
Route::post('/send/mail',[App\Http\Controllers\General::class,'sendMail']);
Route::post('/set/locale',[App\Http\Controllers\General::class,'changeLocale']);
Route::get('/dashboard',[App\Http\Controllers\NoteController::class,'index'])->middleware(['auth'])->name('dashboard');

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

Route::post('/check/2fa',[App\Http\Controllers\TwoFactorSecurityController::class,'check2fa'])->middleware('auth');
Route::post('/enable/2fa',[App\Http\Controllers\TwoFactorSecurityController::class,'enable'])->middleware('auth');
Route::post('/verify/2fa',[App\Http\Controllers\TwoFactorSecurityController::class,'verify2fa'])->middleware('auth');
Route::post('/disable/2fa',[App\Http\Controllers\TwoFactorSecurityController::class,'disable2fa'])->middleware('auth');
Route::post('/verify/2fa/auth',[App\Http\Controllers\NoteController::class,'index'])->middleware('auth')->name('verify2fa');

Route::post('/change/password',[App\Http\Controllers\NoteController::class,'changePassword']);
Route::post('/change/profile',[App\Http\Controllers\NoteController::class,'changeProfile']);

Route::get('/calendar',[App\Http\Controllers\General::class,'calendar'])->middleware(['auth','2fa'])->name('calendar');
Route::get('/profile',[App\Http\Controllers\General::class,'profile'])->middleware(['auth','2fa'])->name('profile');
Route::get('/contact',[App\Http\Controllers\General::class,'contact'])->middleware(['auth','2fa'])->name('contact');
Route::post('/get/notes_data',[App\Http\Controllers\NoteController::class,'notes_data'])->middleware('auth');
Route::get('/', [App\Http\Controllers\General::class,'index'])->middleware('guest');


require __DIR__.'/auth.php';

Auth::routes();
