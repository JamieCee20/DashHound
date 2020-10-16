<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //Named attribute for comments
    protected $fillable = ['comment'];

    // Defined relationship to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Defined relationship to posts
    public function post() {
        return $this->belongsTo('App\Post');
    }
}
