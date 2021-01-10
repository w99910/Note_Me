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
//            $editor = new EditorJS( $req->blocks, $req->config );
//            return $editor;
//            $note = Note::create(['user_id' => Auth()->id(), 'title' => $req->title, 'content' => $req->blocks]);
            return ['route'=>route('dashboard')];
        }catch(\EditorJSException $e){
          return $e;
        }
    }
}
