<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::where('status', 'available')
            ->orderBy('id', 'desc')
            ->paginate(12);

        return view('manageCars', compact('vehicles')); // Updated view name
    }

    public function show(Request $request)
    {
        $critere = $request->input('critere');
        $value = $request->input('value');

        $query = Vehicle::query();

        if ($critere === 'brand') {
            $query->where('brand', $value);
        } elseif ($critere === 'model') {
            $query->where('model', $value);
        } elseif ($critere === 'type') {
            $query->where('type', $value);
        } elseif ($critere === 'capacity') {
            $query->where('capacity', $value);
        } else {
            return redirect()->route('managecars')->withErrors(['Invalid search criterion.']);
        }

        $vehicles = $query->where('status', 'available')->paginate(12);

        return view('manageCars', compact('vehicles')); // Updated view name
    }
    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'price_per_day' => 'required|numeric|min:0',
            'capacity' => 'required|integer|min:1',  // Add validation for capacity
        ]);

        $validated['status'] = 'available';
        $validated['description'] = $request->input('description', ''); // Optional: Add description if provided

        Vehicle::create($validated);

        return redirect()->route('managecars')->with('success', 'Vehicle added successfully!');
    }


    public function edit(Vehicle $vehicle)
    {
        return view('edit', compact('vehicle'));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $validated = $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'price_per_day' => 'required|numeric|min:0',
        ]);

        $vehicle->update($validated);

        return redirect()->route('managecars')->with('success', 'Vehicle updated successfully!');
    }

    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
        return redirect()->route('managecars')->with('success', 'Vehicle deleted successfully!');
    }
    public function ndex()
    {
        $vehicles = Vehicle::where('status', 'available')
            ->orderBy('id', 'desc')
            ->paginate(12);

        return view('user', compact('vehicles')); // Updated view name
    }

    public function how(Request $request)
    {
        $critere = $request->input('critere');
        $value = $request->input('value');

        $query = Vehicle::query();

        if ($critere === 'brand') {
            $query->where('brand', $value);
        } elseif ($critere === 'model') {
            $query->where('model', $value);
        } elseif ($critere === 'type') {
            $query->where('type', $value);
        } elseif ($critere === 'capacity') {
            $query->where('capacity', $value);
        } else {
            return redirect()->route('user')->withErrors(['Invalid search criterion.']);
        }

        $vehicles = $query->where('status', 'available')->paginate(12);

        return view('user', compact('vehicles')); // Updated view name
    }
}
