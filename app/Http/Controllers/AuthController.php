<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirect based on user role
            if (Auth::user()->role === 'admin') {
                return redirect()->route('dashboard');
            } else {
                return redirect()->route('user');
            }
        }

        return back()->with('error', 'Invalid email or password.');
    }

    public function dashboard()
    {
        return view('dashboard'); // Create a dashboard blade file later
    }

    public function userInterface()
    {
        return view('user'); // Create a user interface blade file later
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function showRegisterForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Hash the password using password_hash
        $hashedPassword = password_hash($validated['password'], PASSWORD_BCRYPT);

        // Create the user with the default 'client' role
        \App\Models\User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $hashedPassword,
            'role' => 'client',
        ]);

        return redirect()->route('login.form')->with('success', 'Account created successfully! Please log in.');
    }
}
