<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;

class General extends Controller
{
    public function SignIn(Request $req){

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
        return redirect()->back()->withErrors(['email'=>'Incorrect Email or Password.Please Try again']);
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
        if(!$validator->fails()){
         $user=User::create(['name'=>$req->name,'email'=>$req->email1,'password'=>Hash::make($req->password1)]);
         Auth::Login($user);
         return redirect()->route('dashboard');
        }
        return back()->withErrors(['email'=>'Something went wrong. Please Try again.']);
    }
    public function changeLocale(Request $req){
        if(!in_array($req->value,['en','mm','es'])){
            return response()->json('Error',400);
        }
        App::setLocale($req->value);
      return response()->json(App::getLocale(),200);

    }
}
