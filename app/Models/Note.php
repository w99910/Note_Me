<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
   protected $guarded=[];
    use HasFactory;
    protected $casts=[
      'content'=>'array',
    ];
    public function schedules(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Note_Scheduler::class);
    }
}
