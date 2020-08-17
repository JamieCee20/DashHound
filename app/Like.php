<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    //
    protected $fillable = ['user_id', 'verifieds_id', 'is_liked'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function verified() {
        return $this->belongsToMany(Verified::class);
    }
}
