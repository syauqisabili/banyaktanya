<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    protected $table = 'komentar';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function answer()
    {
        return $this->belongsTo('App\Jawaban');
    }
}
