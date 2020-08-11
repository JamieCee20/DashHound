<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cog\Contracts\Love\Reactable\Models\Reactable as ReactableContract;
use Cog\Laravel\Love\Reactable\Models\Traits\Reactable;


class Verified extends Model implements ReactableContract
{
    //
    use Reactable;
    protected $fillable = ['title', 'description', 'image'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
