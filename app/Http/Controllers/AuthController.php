<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Vehicle;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    public function dashboard()
    {
        // Get the count of reservations
        $totalReservations = Reservation::count();

        // Get the count of available and unavailable vehicles
        $availableCars = Vehicle::where('status', 'available')->count();
        $unavailableCars = Vehicle::where('status', 'unavailable')->count();

        // Get the best customer (with the most reservations)
        $bestCustomer = DB::table('reservations')
            ->select('user_id', DB::raw('count(*) as total'))
            ->groupBy('user_id')
            ->orderByDesc('total')
            ->limit(1)
            ->first();

        $bestCustomerName = $bestCustomer ? User::find($bestCustomer->user_id)->name : 'N/A';

        // Pass the data to the view
        return view('dashboard', [
            'totalReservations' => $totalReservations,
            'availableCars' => $availableCars,
            'unavailableCars' => $unavailableCars,
            'bestCustomer' => $bestCustomerName,
        ]);
    }
}
