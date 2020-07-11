<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reputasi extends Model
{
    protected $table = 'reputasi';
    protected $guarded = [];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
