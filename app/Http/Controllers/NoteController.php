<?php

namespace App\Http\Controllers;

use App\Models\Note_Scheduler;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Note;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class NoteController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
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
                return redirect()->route('dashboard');
            }
            return response()->json('Error');
    }
    public function ViewNote($id){
        $note=Note::with('schedules')->find($id);
        if($note!==null) {
            $user = Auth::user();
            $notes = $user->notes;
            $check = $notes->contains('id', $note->id);
          return $check?view('note',compact('note')):redirect()->route('dashboard')->withErrors(['error'=>'You are not authorized to view that note']);
        }
        else {
           return redirect()->route('dashboard')->withErrors(['error'=>'There is no such note']);
        }

    }
    public function CreateNote(){
        return view('note')->with(['note'=>'']);
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
}
