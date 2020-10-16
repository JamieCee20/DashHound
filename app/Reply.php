<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    //
    protected $fillable = ['body'];

    public function user() {
        return $this->belongsTo('App\User'); // A reply can only belong to 1 user
    }

    public function discussion() {
        return $this->belongsTo('App\Discussion'); // A reply can only have 1 discussion
    }
}
