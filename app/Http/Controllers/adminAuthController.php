<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class adminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.admin-login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            if (Auth::user()->role === 'admin') {
                $request->session()->regenerate();
                return redirect()->intended('admin/dashboard');
            } else {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'You do not have the admin role.',
                ]);
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function showRegistrationForm()
    {
        return view('auth.admin-register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $admin = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin', // Set the role to 'support'
        ]);

        Auth::login($admin);

        return redirect()->intended('admin/dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function create()
    {
        return view('createAgent');
    }

    // Store a newly created support agent in the database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $supportAgent = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'supportagent',
        ]);

        return redirect()->back()->with('success', 'Support Agent created successfully.');
    }

    // Show the form for editing a support agent
    public function edit($id)
    {
        $supportAgent = User::findOrFail($id);
        return view('editAgent', compact('supportAgent'));
    }

    // Update the specified support agent in the database
    public function update(Request $request, $id)
    {
        $supportAgent = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $supportAgent->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $supportAgent->name = $request->name;
        $supportAgent->email = $request->email;
        if ($request->filled('password')) {
            $supportAgent->password = Hash::make($request->password);
        }
        $supportAgent->save();

        return redirect()->back()->with('success', 'Support Agent updated successfully.');
    }

    // Remove the specified support agent from the database
    public function destroy($id)
    {
        $supportAgent = User::findOrFail($id);
        $supportAgent->delete();

        return redirect()->back()->with('success', 'Support Agent deleted successfully.');
    }
}
