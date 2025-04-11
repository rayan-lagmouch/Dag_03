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
        $reservations = collect(); // Empty by default
        $toDate = $request->input('to_date');
        $hasSearched = false;
        $validDate = '2025-04-12'; // Replace with your "correct" date or dynamically set this

        if ($toDate) {
            $hasSearched = true;

            if ($toDate < $validDate) {
                // If the selected date is before the valid date, return an empty collection and a message
                $reservations = collect();
            } else {
                // If the selected date is valid or after the correct date
                $reservations = Reservation::with(['person', 'packageOption', 'reservationStatus'])
                    ->whereHas('reservationStatus', fn($q) => $q->where('name', 'confirmed'))
                    ->whereDate('date', '<=', $toDate)
                    ->orderByDesc('date')
                    ->get();
            }
        }

        return view('reservations.confirmed', [
            'reservations' => $reservations,
            'selectedDate' => $toDate,
            'hasSearched' => $hasSearched,
            'validDate' => $validDate, // Pass the valid date to Blade for later use if needed
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
