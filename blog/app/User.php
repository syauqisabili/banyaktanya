<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isOwner($item)
    {
        return Auth::id() == $item->user->id;
    }

    public function reputations()
    {
        return $this->hasMany('App\Reputasi');
    }

    public function questions()
    {
        return $this->hasMany('App\Pertanyaan');
    }

    public function answers()
    {
        return $this->hasMany('App\Jawaban');
    }

    public function comments()
    {
        return $this->hasMany('App\Komentar');
    }

    public function votes()
    {
        return $this->hasMany('App\Vote');
    } 
}
