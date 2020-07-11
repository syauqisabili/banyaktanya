<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pertanyaan extends Model
{
    protected $table = 'pertanyaan';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    public function answers()
    {
        return $this->hasMany('App\Jawaban');
    }

    public function votes()
    {
        return $this->hasMany('App\Vote');
    }
}
