<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class agentController extends Controller
{
    public function index()
{
    $agents = User::where('role', 'supportagent')->paginate(10);

    return view('admin.support agent.index', compact('agents'));
}


    public function create()
    {
        return view('createAgent');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'support_agent',
        ]);

        return redirect()->route('admin.support_agents.index')->with('success', 'Support agent created successfully.');
    }

    public function edit($id)
    {
        $supportAgent = User::findOrFail($id);
        return view('editAgent', compact('supportAgent'));
    }

    public function update(Request $request, $id)
    {
        $agent = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $agent->name = $request->name;
        $agent->email = $request->email;
        if ($request->filled('password')) {
            $agent->password = bcrypt($request->password);
        }
        $agent->save();

        return redirect()->route('admin.support_agents.index')->with('success', 'Support agent updated successfully.');
    }

    public function destroy($id)
    {
        $agent = User::findOrFail($id);
        $agent->delete();
        return redirect()->route('admin.support_agents.index')->with('success', 'Support agent deleted successfully.');
    }
    public function show($id)
    {

        $agent = User::findOrFail($id);


        return view('admin.support agent.show', compact('agent'));
    }

}
