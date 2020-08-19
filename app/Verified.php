<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Verified extends Model
{
    //
    protected $fillable = ['title', 'description', 'image'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes() {
        return $this->hasMany(Like::class);
    }
}
