<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class General extends Controller
{
    public function SignIn(Request $req){

        $validator=\Validator::make($req->only('email','password'),[
                     'email'=>'email|required',
                    'password'=>'required',
               ]);

               if($validator) {
                   $user = User::where('email', $req['email'])->first();
                   if ($user) {
                       return Hash::check($req['password'], $user->password) ? $this->Login($user, $req) : redirect()->back()->withErrors(['email' => 'Invalid Credentials']);
                   }
               }

        return redirect()->back()->withErrors('email','Invalid Request,Please Try again');
    }
    public function Login($user,$req){
        $req->session()->regenerate();
        Auth::login($user,$req->remember);
        return redirect()->route('dashboard');
    }
    public function SignUp(Request $req){
        $validator=\Validator::make($req->only('email','password'),[
            'name'=>'string|required',
            'email'=>'email|required|unique',
            'password'=>'required',
        ]);
        if($validator){
         $user=User::create(['name'=>$req->name,'email'=>$req->email1,'password'=>Hash::make($req->password1)]);
         Auth::Login($user);
         return redirect()->route('dashboard');
        }
        return back()->withErrors(['email'=>'There is user that already have the email.Please try another email.']);
    }
}
