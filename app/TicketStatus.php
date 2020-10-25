<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketStatus extends Model
{
    // A status can have MANY tickets
    public function tickets() {
        return $this->hasMany('App\Ticket');
    }
}
