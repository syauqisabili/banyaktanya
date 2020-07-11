<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $table = 'vote';
    protected $guarded = [];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function pertanyaan()
    {
        return $this->belongsTo('App\Pertanyaan');
    }
}
