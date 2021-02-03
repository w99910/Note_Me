<?php

namespace App\Http\Livewire;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\NoteController;
use Livewire\Component;
use App\Models\Note;
class Home extends Component
{
    public $notes,$search,$sortyAsc=false;
    public function render()
    {
        return view('livewire.home');
    }
    public function updatedSearch(){
        $this->notes=Note::where('user_id',\Auth::id())->where('title','like','%'.$this->search.'%')->get();
    }
    public function sort(){
            if($this->sortyAsc){
                $this->notes=Auth()->user()->sortNoteByAsc;
            }
            else {
                $this->notes=\Auth::user()->sortNoteByDesc;
            }
            $this->sortyAsc = !$this->sortyAsc;
    }
    public function mount(){
            $this->notes=Auth()->user()->notes;
    }
    public function viewNote($id){

        return redirect()->to('/note/'.$id);
    }
}
