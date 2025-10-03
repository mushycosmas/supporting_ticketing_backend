<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index() {
        $tickets = auth()->user()->tickets()->latest()->get();
        return response()->json($tickets);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'title'=>'required|string',
            'description'=>'required|string',
        ]);

        $ticket = auth()->user()->tickets()->create($data);
        return response()->json($ticket, 201);
    }

    public function show(Ticket $ticket) {
        $this->authorize('view', $ticket);
        return response()->json($ticket);
    }

    public function update(Request $request, Ticket $ticket) {
      
        $data = $request->validate([
            'title'=>'sometimes|string',
            'description'=>'sometimes|string',
            'status'=>'sometimes|in:open,closed'
        ]);

        $ticket->update($data);
        return response()->json($ticket);
    }

    public function destroy(Ticket $ticket) {
       
        $ticket->delete();
        return response()->json(['message'=>'Ticket deleted']);
    }
}
