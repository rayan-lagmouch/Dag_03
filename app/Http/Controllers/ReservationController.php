<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\PackageOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    // ✅ 1. For employees: show all confirmed reservations up to a selected date
    public function confirmed(Request $request)
    {
        // Get the selected date from the request
        $toDate = $request->input('to_date');
        $reservations = collect(); // Default empty collection

        // Check if the user has selected a date
        if ($toDate) {
            // Fetch only reservations for the exact selected date and confirmed status
            $reservations = Reservation::with(['person', 'packageOption', 'reservationStatus'])
                ->whereHas('reservationStatus', fn($q) => $q->where('name', 'confirmed'))
                ->whereDate('date', $toDate)  // Show reservations only for the selected date
                ->orderByDesc('date') // Sort by date (descending order)
                ->get();
        }

        return view('reservations.confirmed', [
            'reservations' => $reservations,
            'selectedDate' => $toDate,
        ]);
    }



    // ✅ 2. For customers: show personal reservations from selected date
    public function index(Request $request)
    {
        if (Auth::user()->hasRole('customer')) {
            $reservations = Reservation::where('person_id', Auth::id())
                ->when($request->from_date, fn($q) => $q->whereDate('date', '>=', $request->from_date))
                ->orderBy('date', 'desc')
                ->get();
        } else {
            $reservations = Reservation::whereHas('reservationStatus', fn($q) => $q->where('name', 'confirmed'))
                ->when($request->to_date, fn($q) => $q->whereDate('date', '<=', $request->to_date))
                ->orderBy('date', 'desc')
                ->get();
        }

        return view('reservations.index', compact('reservations'));
    }

    // Reservation creation
    public function create()
    {
        $packages = PackageOption::all();
        return view('reservations.create', compact('packages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'lane_number' => 'required|integer|in:7,8',
            'package_option' => 'required|exists:package_options,id',
        ]);

        Reservation::create([
            'date' => $request->date,
            'lane_number' => $request->lane_number,
            'package_option_id' => $request->package_option,
            'person_id' => Auth::id(),
            'status' => 'pending', // Default
        ]);

        return redirect()->route('reservations.index')->with('success', 'Reservation created successfully!');
    }

    // Lane editing
    public function editLane($id)
    {
        $reservation = Reservation::findOrFail($id); // Fetch reservation by ID
        return view('reservations.edit-lane', compact('reservation')); // Pass the reservation to the view
    }


    // app/Http/Controllers/ReservationController.php

    public function updateLane(Request $request, $id)
    {
        // Log incoming data
        \Log::info("Received request to update lane for reservation ID: $id");
        \Log::info("Request Data: ", $request->all());

        // Find the reservation
        $reservation = Reservation::findOrFail($id);

        // If the reservation has kids, enforce lane selection rule
        if ($reservation->child_count > 0) {
            $request->validate([
                'lane_number' => 'required|integer|in:7,8', // Only lanes 7 and 8 are allowed if there are kids
            ], [
                'lane_number.in' => 'You can only select lane 7 or 8 if you have kids due to safety walls.',
            ]);
        } else {
            // If there are no kids, allow any lane number between 1 and 8
            $request->validate([
                'lane_number' => 'required|integer|in:1,2,3,4,5,6,7,8',
            ]);
        }

        // Update the lane number
        $reservation->lane_id = $request->lane_number;
        $reservation->save();

        // Log successful update
        \Log::info("Lane updated successfully for reservation ID: $id");

        // Redirect with success message
        return redirect()->route('reservations.index')->with('success', 'Lane updated successfully');
    }







    // Package editing
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
}
