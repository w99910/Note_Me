<?php

namespace App\Models;

use App\Models\Note;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function notes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Note::class);
    }
    public function sortNoteByAsc()
    {
            return $this->hasMany(Note::class)->orderBy('created_at','asc');
    }
    public function sortNoteByDesc()
    {
            return $this->hasMany(Note::class)->orderBy('created_at','desc');
    }
    public function schedules()
    {
        return $this->hasMany(Note_Scheduler::class);
    }
    public function getTrashesAttribute()
    {
        return Note::onlyTrashed()->where('user_id',\Auth::id())->get();
    }

}
