<?php

namespace App\Http\Controllers;

use App\Mail\SupportMail;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;

class General extends Controller
{
    public function index(){
        if(\Session::has('locale')){
           App::setLocale(\Session::get('locale'));
        }
        $locale=App::getLocale();
        $localization=__('messages');
//    dd(Session::get('locale'),$locale);
        return view('welcome_page',compact('localization','locale'));
    }
    public function calendar(){
        if(\Session::has('locale')){
            App::setLocale(\Session::get('locale'));
        }
        $locale=App::getLocale();
        $localization=collect(__('messages' ))->toJson();
        return view('calendar',compact('locale','localization'));
    } public function profile(){
        if(\Session::has('locale')){
            App::setLocale(\Session::get('locale'));
        }
        $locale=App::getLocale();
        $localization=collect(__('messages' ))->toJson();
        $user=Auth()->user();
        return view('profile',compact('locale','localization','user'));
    } public function contact(){
        if(\Session::has('locale')){
            App::setLocale(\Session::get('locale'));
        }
        $locale=App::getLocale();
        $localization=collect(__('messages' ))->toJson();
        return view('contact',compact('locale','localization'));
    }
    public function SignIn(Request $req){
        if(\Session::has('locale')){
            App::setLocale(\Session::get('locale'));
        }
        $validator=\Validator::make($req->only('email','password'),[
                     'email'=>'email|required',
                    'password'=>'required',
               ]);

               if($validator) {
                   if (Auth::attempt(['email'=>$req->email,'password'=>$req->password])) {

                       $user = User::where('email', $req->email)->first();
                       return Hash::check($req['password'], $user->password) ? $this->Login($user, $req) : redirect()->back()->withErrors(['email' => 'Invalid Credentials']);
                   }
               }
        return redirect()->back()->withErrors(['email'=>__('messages.Incorrect_email_or_password')]);
    }
    public function Login($user,$req){
        $req->session()->regenerate();
        Auth::login($user,$req->remember);
        return redirect()->route('dashboard');
    }
    public function SignUp(Request $req){
        $validator=\Validator::make($req->all(),[
            'name'=>'string|required',
            'email1'=>'unique:users,email|email|required',
            'password1'=>'required',
        ]);
        if(\Session::has('locale')){
            App::setLocale(\Session::get('locale'));
        }
        if(!$validator->fails()){
            $user=User::where('email',$req->email)->first();
            return $user===null?$this->createUser($req):back()->withErrors(['email'=>__('messages.already_user')]);
        }
        return back()->withErrors(['email'=>__('messages.went_wrong')]);
    }
    public function createUser($req){
        $user=User::create(['name'=>$req->name,'email'=>$req->email1,'password'=>Hash::make($req->password1)]);
        Auth::Login($user);
        return redirect()->route('dashboard');
    }
    public function changeLocale(Request $req){
        $locale=$req->value;
        if(!in_array($locale,['en','mm','es','jpn'])){
            return response()->json('Error',400);
        }
        \Session::put('locale', $locale);
        App::setLocale($locale);
         $files=__('messages');
      return response()->json($files,200);

    }
    public function sendMail(Request $req){
        \Illuminate\Support\Facades\Mail::to('testlesson2019@gmail.com')->send(new SupportMail($req->name,$req->title,$req->email,$req->contents));
          return 'success';
    }

}
