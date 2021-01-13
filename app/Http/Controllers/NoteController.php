<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use \EditorJS\EditorJS;
class NoteController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    public function create(Request $req){

        $validator=$this->validate($req,['title'=>'required|string']);

        try {
            $note = Note::updateOrCreate(['user_id' => Auth()->id(), 'id' => $req->id],[ 'title' => $req->title,'content' => $req->blocks,'color'=>$req->color]);
            return ['route'=>route('dashboard')];
        }catch(\EditorJSException $e){
          return $e;
        }
    }
    public function ViewNote($id){
        $note=Note::find($id);
        return view('note',compact('note'));
    }
    public function CreateNote(){
        return view('note')->with(['note'=>'']);
    }
}
