<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelLike\Traits\Likeable;

class Verified extends Model
{
    //
    use Likeable;
    protected $fillable = ['title', 'description', 'image'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
