<?php

namespace App\Http\Controllers;

use App\Events\TicketReply;
use App\Ticket;
use Illuminate\Support\Str;
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
                'image' => 'image'
            ]);

            clean($data);

            if($request->file('image')) {
                $file = $request->file('image');
                $string = Str::random(25);
                $name = $string.'.'.$file->getClientOriginalExtension();
        
                $dest = 'storage/ticketFile/';
                $file->move($dest, $name);
                $input = $request->all();
                $input['image'] = $name;
        
                auth()->user()->ticketBodies()->create([
                    'ticket_id' => $request->ticket_id,
                    'user_id' => auth()->user()->id,
                    'body' => clean($data['body']),
                    'image' => $name
                ]);
                
            } 
            else {
                auth()->user()->ticketBodies()->create([
                    'ticket_id' => $request->ticket_id,
                    'user_id' => auth()->user()->id,
                    'body' => clean($data['body'])
                ]);
            }
            return redirect()->route('tickets.show', [$ticketReturn])->with('success', 'Reply sent!');
        }

        return redirect()->route('tickets.show', [$ticketReturn])->with('error', 'An error occured!');
    }
}
