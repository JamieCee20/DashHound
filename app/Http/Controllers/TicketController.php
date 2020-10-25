<?php

namespace App\Http\Controllers;

use App\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index() {
        $tickets = Ticket::orderBy('created_at', 'DESC')->paginate(20);
        // dd($tickets);
        return view('tickets.index', compact('tickets'));
    }

    public function create() {

    }

    public function store() {

    }

    public function show(Ticket $ticket) {
        return view('tickets.show', compact('ticket'));
    }

    public function edit() {

    }

    public function update() {

    }

    public function destroy() {

    }
}
