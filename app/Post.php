<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    // protected $guarded = [];
    protected $fillable = ['title', 'slug', 'description', 'image', 'spoilers'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function getRecent() {
        return $this->comments()->orderBy('created_at','desc')->first();
    }
}
