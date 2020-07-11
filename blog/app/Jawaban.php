<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    protected $table = 'jawaban';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function question()
    {
        return $this->belongsTo('App\Pertanyaan');
    }

    public function comments()
    {
        return $this->hasMany('App\Komentar');
    }
}
