<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketBody extends Model
{
    //
    protected $fillable = ['body', 'image', 'ticket_id'];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function ticket() {
        return $this->belongsTo('App\Ticket');
    }
}
