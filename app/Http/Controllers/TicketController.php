<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\Storage; // Add this for file storage

class TicketController extends Controller{


    public function index()
    {
        // Your logic for listing tickets (if needed)
    }

    public function adminIndex(Request $request)
    {
        $allowedSorts = ['created_at', 'state', 'priority'];
        $sort = $request->input('sort', 'created_at');
        $order = $request->input('order', 'asc');

        if (!in_array($sort, $allowedSorts)) {
            $sort = 'created_at';
        }

        $tickets = Ticket::orderBy($sort, $order)->paginate(10);
        return view('admin.tickets.index', compact('tickets'));
    }



    public function create()
    {
        return view('createTicket');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required',
            'category' => 'required|in:reclamation,service',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $ticket = new Ticket();
        $ticket->user_id = auth()->user()->id;
        $ticket->title = $request->title;
        $ticket->description = $request->description;
        $ticket->category = $request->category;
        $ticket->priority = $request->priority;
        $ticket->state = 'Open';
        $ticket->created_at = now();

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filePath = $file->store('attachments', 'public'); // Store file and get path
            $ticket->attachment = $filePath;
        }

        $ticket->save();

        return redirect()->route($this->getDashboardRoute())->with('success', 'Ticket created successfully.');
    }

    public function createAgent()
    {
        $clients = User::where('role', 'client')->get();
        return view('createTicketAgent', compact('clients'));
    }

    public function storeAgent(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|in:reclamation,service',
            'priority' => 'required',
            'user_id' => 'required|exists:users,id',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $ticket = new Ticket();
        $ticket->user_id = $request->user_id; // Assigned to client
        $ticket->title = $request->title;
        $ticket->description = $request->description;
        $ticket->category = $request->category;
        $ticket->priority = $request->priority;
        $ticket->state = 'Open'; // Default status

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filePath = $file->store('attachments', 'public'); // Store file and get path
            $ticket->attachment = $filePath;
        }

        $ticket->save();

        return redirect()->route($this->getDashboardRoute())->with('success', 'Ticket created successfully');
    }

    public function show($id)
    {
        $ticket = Ticket::findOrFail($id);
        return view('viewTicket', compact('ticket'));
    }

    public function edit($id)
    {
        $ticket = Ticket::findOrFail($id);
        return view('editTicket', compact('ticket'));
    }

    public function update(Request $request, $id)
    {



    // Validate the incoming request
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'category' => 'required|in:service,reclamation',
        'priority' => 'required|in:low,medium,high',
        'state' => 'nullable|in:Open,In Progress,Closed,On Hold',
        'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);

    // Find the ticket by ID
    $ticket = Ticket::findOrFail($id);

    // Update fields other than state
    $ticket->title = $request->title;
    $ticket->description = $request->description;
    $ticket->category = $request->category;
    $ticket->priority = $request->priority;

    // Only allow state updates for support agents or admins
    if (Auth::user()->role === 'supportagent' || Auth::user()->role === 'admin') {
        if ($request->filled('state')) {
            $ticket->state = $request->state;
        }
    }

    // Handle file attachment
    if ($request->hasFile('attachment')) {
        if ($ticket->attachment) {
            Storage::disk('public')->delete($ticket->attachment);
        }

        $file = $request->file('attachment');
        $filePath = $file->store('attachments', 'public');
        $ticket->attachment = $filePath;
    }

    // Save the ticket
    $ticket->save();

    return redirect()->route($this->getDashboardRoute())->with('success', 'Ticket updated successfully.');
}





    public function updateStatus(Request $request, Ticket $ticket)
    {
        $request->validate([
            'state' => 'required|string|in:Open,In Progress,Closed,On Hold',
        ]);

        $ticket->state = $request->state;
        $ticket->save();

        return redirect()->route($this->getDashboardRoute())->with('status', 'Ticket status updated successfully!');
    }

    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);

        if ($ticket->attachment) {
            Storage::disk('public')->delete($ticket->attachment);
        }

        $ticket->delete();

        return redirect()->route($this->getDashboardRoute())->with('success', 'Ticket deleted successfully');
    }

    private function getDashboardRoute()
    {
        $user = auth()->user();

        if ($user->role == 'client') {
            return 'dashboard';
        } elseif ($user->role == 'supportagent') {
            return 'agent.dashboard';
        } elseif ($user->role == 'admin') {
            return 'admin.dashboard';
        }

        return 'dashboard';
    }

    public function downloadAttachment($id)
{
    $ticket = Ticket::findOrFail($id);

    if ($ticket->attachment) {
        return Storage::disk('public')->download($ticket->attachment);
    }

    return redirect()->back()->with('error', 'Attachment not found.');
}
}
