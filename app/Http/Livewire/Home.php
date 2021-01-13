<?php

namespace App\Http\Livewire;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\NoteController;
use Livewire\Component;
use App\Models\Note;
class Home extends Component
{
    public $notes;
    public function render()
    {
        return view('livewire.home');
    }
    public function mount(){
            $this->notes=Auth()->user()->notes;
    }
    public function viewNote($id){

        return redirect()->to('/note/'.$id);
    }
}
