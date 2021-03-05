<?php

namespace App\Http\Controllers;

use App\User;
use App\Ticket;
use App\TicketBody;
use App\TicketCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $issueTypes = TicketCategory::all();
        $usertickets = Ticket::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get();

        $categories = TicketCategory::all();
        $ticketStaff = User::all();


        if(request()->category) {
            $tickets = Ticket::where('ticket_category', request()->category)->paginate(20);
            $moderatortickets = Ticket::where('manager_id', Auth::user()->id)->where('ticket_category', request()->category)->orderBy('created_at', 'DESC')->paginate(20);
        } else {
            $tickets = Ticket::orderBy('created_at', 'DESC')->paginate(20);
            $moderatortickets = Ticket::where('manager_id', Auth::user()->id)->orderBy('created_at', 'DESC')->paginate(20);
        }

        if(request()->staff && request()->staff !== "empty") {
            $tickets = Ticket::where('manager_id', request()->staff)->paginate(20);
        } elseif(request()->staff && request()->staff == "empty") {
            $tickets = Ticket::where(['manager_id' => null])->paginate(20);
        }


        return view('tickets.index', compact('tickets', 'issueTypes', 'usertickets', 'moderatortickets', 'categories', 'ticketStaff'));
    }

    public function create() {
        //
        $categories = TicketCategory::pluck('name', 'id');
        return view('tickets.create', compact('categories'));
    }

    public function store(Request $request) {
        $data = $request->validate([
            'title' => 'required|max:255|string',
            'body' => 'required|string',
            'image' => 'image',
            'category' => 'required',
        ]);
        clean($data);

        $ticketId = Str::random(15);
        $current = Ticket::where('ticket_id', $ticketId)->first();
        if($current) {
            $ticketId = Str::random(15);
        } else {
            $newTicket = auth()->user()->tickets()->create([
                'ticket_id' => $ticketId,
                'title' => clean($data['title']),
                'ticket_category' => $data['category'],
                'ticket_status' => 3
            ]);

            if($newTicket->exists) {

                $ticketBody = Ticket::where('ticket_id', $ticketId)->first();

                if($request->file('image')) {
                    $file = $request->file('image');
                    $string = Str::random(25);
                    $name = $string.'.'.$file->getClientOriginalExtension();
            
                    $dest = public_path('storage/ticketFile/');
                    $file->move($dest, $name);
                    $input = $request->all();
                    $input['image'] = $name;
            
                    auth()->user()->ticketBodies()->create([
                        'ticket_id' => $ticketBody->id,
                        'user_id' => auth()->user()->id,
                        'body' => $data['body'],
                        'image' => $name
                    ]);
                } else {
                    auth()->user()->ticketBodies()->create([
                        'ticket_id' => $ticketBody->id,
                        'user_id' => auth()->user()->id,
                        'body' => $data['body']
                    ]);
                }
                
                return redirect('/tickets')->with('success', 'Ticket successfully created!');
            }
        }
    }

    public function show(Ticket $ticket) {
        $ticketbodies = TicketBody::where('ticket_id', $ticket->id)->orderBy('created_at', 'DESC')->paginate(8);
        $staffUsers = User::all();
        return view('tickets.show', compact('ticket', 'ticketbodies', 'staffUsers'));
    }

    public function edit() {

    }

    public function update() {

    }

    public function destroy() {

    }

    public function closeTicket(Ticket $ticket) {
        if($ticket->status->name !== "Closed") {
            $ticket->ticket_status = 2;
            $ticket->save();
            return redirect()->route('tickets.show', compact('ticket'))->with('success', 'Ticket successfully closed');
        } else {
            return redirect()->route('tickets.show', compact('ticket'))->with('error', 'Ticket is already closed!');
            // "Ticket Would Return already closed";
        }
    }

    public function assignUser(User $user, Ticket $ticket) {
        $specificTicket = Ticket::where('ticket_id', $ticket->ticket_id)->first();
        if($specificTicket->manager_id !== $user->id) {
            $specificTicket->manager_id = $user->id;
            $specificTicket->ticket_status = 1;
            $specificTicket->save();
            return redirect()->route('tickets.show', compact('ticket'))->with('success', 'Staff Member Changed!');
        } else {
            return redirect()->route('tickets.show', compact('ticket'))->with('error', 'Staff Member already assigned!');
        }
    }
}
