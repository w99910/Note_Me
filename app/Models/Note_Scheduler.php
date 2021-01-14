<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note_Scheduler extends Model
{
    protected $guarded=[];
    protected $with=['note'];
    protected $casts=['created_at'=>"datetime:Y-m-d"];
    use HasFactory;
    public $timestamps = false;
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class);
    }
    public function note(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Note::class);
    }
}
