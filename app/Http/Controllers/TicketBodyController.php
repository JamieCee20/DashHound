<?php

namespace App\Http\Controllers;

use App\Ticket;
use Illuminate\Http\Request;

class TicketBodyController extends Controller
{
    //

    public function index() {

    }

    public function create() {

    }

    public function store(Request $request) {

        $ticketReturn = Ticket::where('id', $request->ticket_id)->first();

        if($ticketReturn->ticket_status == 2) {
            return redirect()->route('tickets.show', [$ticketReturn])->with('error', 'Ticket has been closed!');
        } else {

            $data = $request->validate([
                'body' => 'required|max:255|string',
                'file' => 'image'
            ]);

            clean($data);

            if($request->file('file')) {
                $file = $request->file('file');
                $string = Str::random(25);
                $name = $string.'.'.$file->getClientOriginalExtension();
        
                $dest = public_path('storage/ticketFile/');
                $file->move($dest, $name);
                $input = $request->all();
                $input['file'] = $name;
        
                auth()->user()->ticketBodies()->create([
                    'ticket_id' => $request->ticket_id,
                    'user_id' => auth()->user()->id,
                    'body' => $data['body'],
                    'image' => $name
                ]);
            } else {
                auth()->user()->ticketBodies()->create([
                    'ticket_id' => $request->ticket_id,
                    'user_id' => auth()->user()->id,
                    'body' => $data['body']
                ]);
            }
        }

        return redirect()->route('tickets.show', [$ticketReturn])->with('success', 'Reply sent!');
    }

    public function show(Ticket $ticket) {

    }

    public function edit() {

    }

    public function update() {

    }

    public function destroy() {

    }
}
