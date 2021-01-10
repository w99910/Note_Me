<?php

namespace App\Http\Livewire;

use Livewire\Component;


class Note extends Component
{
    public $title;
    public $content;
    public function render()
    {
        return view('livewire.note');
    }
     protected $rules=[
       'title'=>'required',
         'content'=>'required',
     ];
    public function create_post()
    {    $this->validate();

    }
}
