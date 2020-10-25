<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    //Primary Name
    public function getRouteKeyName()
    {
        return "ticket_id";
    }

    protected $fillable = ['title', 'body'];

    // A Ticket can only belong to ONE user
    public function user() {
        return $this->belongsTo('App\User');
    }

    public function asignee() {
        return $this->belongsTo('App\User', 'manager_id');
    }

    // A Ticket can only have ONE category
    public function category() {
        return $this->belongsTo('App\TicketCategory', 'ticket_category');
    }

    // A ticket can only have ONE status
    public function status() {
        return $this->belongsTo('App\TicketStatus', 'ticket_status');
    }
}
