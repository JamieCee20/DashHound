<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = ['name', 'order', 'slug'];

    // Define single discussion
    public function discussions() {
        return $this->hasMany('App\Discussion');
    }

}
