<?php

namespace App\Http\Controllers;

use App\Models\TwoFactorSecurity;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TwoFactorSecurityController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        $user=\Auth::user();
        $secret='';
        $google2fa_url='';
        if($user->password_security()->exists()){
            $google2fa=new \PragmaRX\Google2FAQRCode\Google2FA();
            $google2fa_url=$google2fa->getQRCodeInline(
                'Testing 2FA',
                $user->email,
                $user->password_security->google2fa_secret
            );
            $secret=$user->password_security->google2fa_secret;
        }

        $data= array('google2fa_url' => $google2fa_url,'google2fa_secret'=>$secret,'user'=>$user);
        return view('google2fa',compact('data'));
    }
    public function enable(): \Illuminate\Http\JsonResponse
    {
        $user=\Auth::user();
        $google2fa=new \PragmaRX\Google2FAQRCode\Google2FA();
        $password_security=TwoFactorSecurity::firstOrNew(['user_id'=>$user->id]);
        $password_security->user_id=$user->id;
        $password_security->google2fa_enable=0;
        $password_security->google2fa_secret=$google2fa->generateSecretKey();
        $password_security->save();

            $google2fa=new \PragmaRX\Google2FAQRCode\Google2FA();
            $google2fa_url=$google2fa->getQRCodeInline(
                'Note Me',
                $user->email,
                $user->password_security->google2fa_secret
            );

        return response()->json(['user'=>$user,'google2fa_url' => $google2fa_url],200);
    }
    public function verify2fa(Request $request): \Illuminate\Http\JsonResponse
    {
        $user=\Auth::user();
        $google2fa=new \PragmaRX\Google2FAQRCode\Google2FA();
        $request->validate(['verify_code'=>'required']);
        $secret=$request->verify_code;
        $verify=$google2fa->verifyKey($user->password_security->google2fa_secret,$secret);
        if($verify) {
            $password_security=$user->password_security;
            $password_security->google2fa_enable=1;
            $password_security->save();
            return response()->json(['message'=>'Your 2FA has been successfully enabled'],200);
        }
        return response()->json(['message'=>'Incorrect Key ... Please Try again'],400);
    }
//    public function verifyAuth(Request $request){
//        $user=\Auth::user();
//        $google2fa=new \PragmaRX\Google2FAQRCode\Google2FA();
//        $request->validate(['verify_code'=>'required']);
//        $secret=$request->verify_code;
//        $verify=$google2fa->verifyKey($user->password_security->google2fa_secret,$secret);
//        Log::info(['secret'=>$secret,'verify'=>$verify]);
//        if($verify) {
//            return redirect()->route('dashboard');
//        }
//        return redirect()->back()->withErrors(['message'=>'Incorrect Code.Please Try again']);
//    }
    public function check2fa(){
        $user=Auth()->user();
        $google2fa_url='';
        if($user->password_security()->exists()){
            $google2fa=new \PragmaRX\Google2FAQRCode\Google2FA();
            $google2fa_url=$google2fa->getQRCodeInline(
                'Note Me',
                $user->email,
                $user->password_security->google2fa_secret
            );
            $secret=$user->password_security->google2fa_secret;
        }
        return response()->json(['user'=>User::with('password_security')->find(Auth()->id()),'google2fa_url'=>$google2fa_url]);
    }
    public function disable2fa(): \Illuminate\Http\JsonResponse
    {
        $user=\Auth::user();
//       $user->password_security->google2fa_enable=0;
        $password2fa=$user->password_security;
        $password2fa->delete();

        return response()->json(['message'=>'Your two factor authentication has been disabled','user'=>User::with('password_security')->find(Auth()->id())]);
    }
}
