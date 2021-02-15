<?php

namespace App\Http\Controllers;

use App\Models\Note_Scheduler;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Note;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class NoteController extends Controller
{

    public function __construct(){
        $this->middleware(['auth','2fa']);
    }
    public function index(){
        if(\Session::has('locale')){
            App::setLocale(\Session::get('locale'));
        }
        $localization=collect(__('messages' ))->toJson();
        $locale=App::getLocale();

        return view('dashboard',compact('localization','locale'));
    }
    public function create(Request $req){

        $validator=$this->validate($req,['title'=>'required|string']);

        try {

            $note = Note::updateOrCreate(['user_id' => Auth()->id(), 'id' => $req->id],[ 'title' => $req->title,'content' => $req->blocks,'color'=>$req->color]);

            if($note->schedules()->count()!==0){
                $note->schedules()->delete();
            }
            if(sizeof($req->schedules)!==0){
                Log::info($req->schedules);
                foreach ($req->schedules as $schedule){
                    Log::info($schedule);
                    Note_Scheduler::updateOrCreate(['created_at'=>Carbon::parse($schedule),'note_id'=>$note->id],['user_id' => Auth()->id()]);
                }
            }

            return ['route'=>route('dashboard')];
        }catch(\EditorJSException $e){
          return $e;
        }
    }
    public function delete(Request $req){
            $note=Note::find($req->id);
            if($note->user_id===Auth::id()){
                $note->delete();
                return route('dashboard');
            }
            return response()->json('Error');
    }
    public function ViewNote($id){
        $note=Note::with('schedules')->find($id);
        if($note!==null) {
            $user = Auth::user();
            $notes = $user->notes;
            $check = $notes->contains('id', $note->id);
            if(\Session::has('locale')){
                App::setLocale(\Session::get('locale'));
            }
            $localization=collect(__('messages' ))->toJson();
            $locale=App::getLocale();
          return $check?view('note',compact('note','localization','locale')):redirect()->route('dashboard')->withErrors(['error'=>'You are not authorized to view that note']);
        }
        else {
           return redirect()->route('dashboard')->withErrors(['error'=>'There is no such note']);
        }

    }
    public function notes_data(){
        $user=Auth::user();
        $notes_total=$user->notes()->count();
        $current_notes=$user->current_month_notes->count();
        $schedules_total=$user->schedules()->count();
        $array=['total_notes'=>$notes_total,'total_scheduled_notes'=>$schedules_total,'current_month_notes'=>$current_notes];
        return response()->json($array,200);
    }
    public function CreateNote(){
        if(\Session::has('locale')){
            App::setLocale(\Session::get('locale'));
        }
        $localization=collect(__('messages' ))->toJson();
        $locale=App::getLocale();
        $note='';
        return view('note',compact('note','localization','locale'));
    }
    public function changePassword(Request $req){
        if(\Session::has('locale')){
            App::setLocale(\Session::get('locale'));
        }
               $user=Auth()->user();
               if(Hash::check($req->password,$user->password)){
                   $user->password=Hash::make($req->new_password);
                   return response()->json(['message'=>__('messages.success_change'),'code'=>'success']);
               }
               return response()->json(['message'=>__('messages.incorrect_password'),'code'=>'error']);

    }
    public function changeProfile(Request $req)
    {
        if(\Session::has('locale')){
            App::setLocale(\Session::get('locale'));
        }
        $user=Auth()->user();
        try {
            if(User::where('email',$req->email)->first()!==null){
                return response()->json(['message'=>'Email is already taken.Try another email.','code'=>'error']);
            }
            $user->name = $req->name;
            $user->email = $req->email;
            $user->save();
        return response()->json(['user'=>$user,'message'=>'Successfully Changed','code'=>'success']);
        } catch (\Exception $e){
            return response()->json(['message'=>$e,'code'=>'error']);
        }
    }
    public function notes(){
            $user=User::find(Auth::id());
            Log::info($user->schedules);
            return $user!==null?response()->json(['schedules'=>$user->schedules]):['error'=>'There is no such user'];
    }
    public function schedules(){
        $user=Auth::user();
        return response()->json($user->schedules);
    }
    public function trash(){
        return response()->json(Note::onlyTrashed()->where('user_id',Auth::id())->get());
    }
    public function Restore(Request $req){
        $note=Note::onlyTrashed()->find($req->id);
        try{
            if(Auth::id()===$note->user_id) {
                $note->restore();
                return response()->json(route('dashboard'));
            }else{
                return response()->json('Do not own notes');
            }
           }catch(\Exception $e){
               return response()->json($e);
           }

    }
    public function deleteAll(){
               $notes=Auth::user()->trashes;
               if(!empty($notes)){
                   foreach ($notes as $note){
                       $note->forceDelete();
                   }
                   return response()->json('Success');
               }
               return response()->json('Cannot');
    }
    public function deleteTrash(Request $req){
            $note=Note::find($req->id);
            if($note->user_id === Auth::id()){
                $note->forceDelete();
                return response()->json('Success');
            }
        return response()->json('Cannot');
    }
}
