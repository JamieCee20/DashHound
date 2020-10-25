<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketCategory extends Model
{
    // A category belongs to MANY tickets
    public function tickets() {
        return $this->hasMany('App\Ticket');
    }
}
