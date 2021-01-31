<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Note extends Model
{
    use SoftDeletes;
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
