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

    public function index()
    {
        // Fetch all reservations with related user and vehicle details
        $reservations = Reservation::with('user', 'vehicle')->get();

        // Pass reservations to the view
        return view('managereservations', compact('reservations'));
    }


    // Update the status of a reservation
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,completed',
        ]);

        $reservation = Reservation::findOrFail($id);
        $reservation->status = $request->status;
        $reservation->save();

        // Update vehicle status when reservation is confirmed
        if ($request->status === 'confirmed') {
            $vehicle = Vehicle::findOrFail($reservation->vehicle_id);
            $vehicle->status = 'unavailable';  // Set the vehicle status to 'unavailable'
            $vehicle->save();
        }

        // Optionally handle other status changes (e.g., make the vehicle available again)
        if ($request->status === 'cancelled' || $request->status === 'completed') {
            $vehicle = Vehicle::findOrFail($reservation->vehicle_id);
            $vehicle->status = 'available';  // Set the vehicle status back to 'available'
            $vehicle->save();
        }

        return back()->with('success', 'Reservation status updated successfully.');
    }
    public function destroy($id)
    {
        // Find the reservation by ID
        $reservation = Reservation::findOrFail($id);

        // Optional: Update the vehicle status to "available" when the reservation is deleted
        $vehicle = Vehicle::findOrFail($reservation->vehicle_id);
        $vehicle->status = 'available';  // Set the vehicle status back to 'available'
        $vehicle->save();

        // Delete the reservation
        $reservation->delete();

        return back()->with('success', 'Reservation deleted successfully.');
    }
    public function showReservations()
    {
        // Get reservations for the authenticated user
        $reservations = Reservation::where('user_id', Auth::id())->get();

        // Pass the reservations to the view
        return view('mesreservations', compact('reservations'));
    }
}
