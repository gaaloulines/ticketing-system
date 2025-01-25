<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class dashboardController extends Controller
{
    public function client()
    {
        if (Auth::user()->role !== 'client') {
            return redirect()->route($this->getDashboardRoute());
        }

        $tickets = Ticket::with('user')->where('user_id', auth()->user()->id)->get();
        return view('client_dashboard', compact('tickets'));
    }

    public function agent()
{
    if (Auth::user()->role !== 'supportagent') {
        return redirect()->route($this->getDashboardRoute());
    }

    $sort = request()->get('sort', 'created_at');
    $order = request()->get('order', 'desc');

    if (in_array($sort, ['priority', 'state', 'created_at'])) {
        $tickets = Ticket::with('user')->orderBy($sort, $order)->get();
    } else {
        $tickets = Ticket::with('user')->orderBy('created_at', 'desc')->get();
    }

    return view('agent_dashboard', compact('tickets', 'sort', 'order'));
}

public function admin()
{
    if (Auth::user()->role !== 'admin') {
        return redirect()->route($this->getDashboardRoute());
    }

    $clients = User::where('role', 'client')->get();
    $agents = User::where('role', 'supportagent')->get();
    $sort = request()->get('sort', 'created_at');
    $order = request()->get('order', 'desc');

    if (in_array($sort, ['priority', 'state', 'created_at'])) {
        $tickets = Ticket::with('user')->orderBy($sort, $order)->get();
    } else {
        $tickets = Ticket::with('user')->orderBy('created_at', 'desc')->get();
    }

    return view('admin_dashboard', compact('clients', 'agents', 'tickets', 'sort', 'order'));
}

    private function getDashboardRoute()
    {
        $user = Auth::user();

        if ($user->role == 'client') {
            return 'dashboard';
        } elseif ($user->role == 'supportagent') {
            return 'agent.dashboard';
        } elseif ($user->role == 'admin') {
            return 'admin.dashboard';
        }

        return 'dashboard';
    }
}
