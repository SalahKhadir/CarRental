<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function create($vehicle_id)
    {
        $vehicle = Vehicle::findOrFail($vehicle_id);
        return view('reservation.create', compact('vehicle'));
    }

    public function store(Request $request)
    {
        // Validate the input data
        $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
        ]);

        // Get the vehicle details
        $vehicle = Vehicle::findOrFail($request->vehicle_id);

        // Calculate the total price
        $start_date = \Carbon\Carbon::parse($request->start_date);
        $end_date = \Carbon\Carbon::parse($request->end_date);
        $days = $start_date->diffInDays($end_date);

        if ($days <= 0) {
            return back()->withErrors(['end_date' => 'End date must be after the start date.']);
        }

        $totalPrice = $days * $vehicle->price_per_day;

        // Create the reservation
        $reservation = new Reservation();
        $reservation->user_id = Auth::id();
        $reservation->vehicle_id = $vehicle->id;
        $reservation->start_date = $request->start_date;
        $reservation->end_date = $request->end_date;
        $reservation->status = 'pending';
        $reservation->total_price = $totalPrice;
        $reservation->created_at = now();
        $reservation->updated_at = now();
        $reservation->save();


        return redirect()->route('user')->with('success', 'Reservation placed successfully and is pending approval.');
    }
}
