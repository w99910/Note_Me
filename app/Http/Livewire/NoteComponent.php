<?php

namespace App\Http\Livewire;

use Livewire\Component;
use \App\Models\Note;

class NoteComponent extends Component
{
    public $title;
    public $content;

    protected $rules=[
        'title'=>'required',
        'content'=>'required',
    ];

    public function render()
    {
        return view('livewire.note-component');
    }

    public function create_post()
    {    $this->validate();
           Note::create(['user_id'=>Auth()->id(),'title'=>$this->title,'content'=>$this->content]);
           return redirect()->route('dashboard');
    }
}
