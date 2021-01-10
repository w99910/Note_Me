<?php

namespace App\Http\Livewire;

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
}
