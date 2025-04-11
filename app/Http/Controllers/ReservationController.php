<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\PackageOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        $reservations = Reservation::where('person_id', Auth::id())
        ->when($request->from_date, fn($q) => $q->whereDate('date', '>=', $request->from_date))
        ->orderBy('date', 'desc')
        ->get();    
        
       

        return view('reservations.index', compact('reservations'));
    }

    public function editLane($id)
    {
        $reservation = Reservation::findOrFail($id);
        return view('reservations.edit-lane', compact('reservation'));
    }

    public function updateLane(Request $request, $id)
    {
        $request->validate(['lane_number' => 'required|integer|in:7,8']);

        $reservation = Reservation::findOrFail($id);
        $reservation->lane_number = $request->lane_number;
        $reservation->save();

        return redirect()->route('reservations.index')->with('success', 'Lane number updated');
    }

    public function editPackage($id)
    {
        $reservation = Reservation::findOrFail($id);
        $packages = PackageOption::all();
        return view('reservations.edit-package', compact('reservation', 'packages'));
    }

    public function updatePackage(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);

        if ($request->package_option == 'bachelor_party') {
            return back()->withErrors(['package_option' => 'Bachelor party package is not suitable for children']);
        }

        $reservation->package_option_id = $request->package_option;
        $reservation->save();

        return redirect()->route('reservations.index')->with('success', 'Package option updated');
    }

    // app/Http/Controllers/ReservationController.php

    public function create()
    {
        $packages = PackageOption::all(); // Fetch all package options for the dropdown
        return view('reservations.create', compact('packages'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'date' => 'required|date|after_or_equal:today', // Ensure the date is today or later
            'lane_number' => 'required|integer|in:7,8',
            'package_option' => 'required|exists:package_options,id',
        ]);

        // Create the reservation in the database
        Reservation::create([
            'date' => $request->date,
            'lane_number' => $request->lane_number,
            'package_option_id' => $request->package_option,
            'person_id' => Auth::id(), // Automatically associate with the authenticated user
            'status' => 'pending', // You can change the default status as needed
        ]);

        // Redirect back with a success message
        return redirect()->route('reservations.index')->with('success', 'Reservation created successfully!');
    }

}
