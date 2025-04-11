<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\PackageOption;
use App\Models\Lane;
use App\Models\OpeningTime;
use App\Models\ReservationStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ReservationController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->hasRole('customer')) {
            $reservations = Reservation::with('packageOption') // Eager load the related package options
            ->where('person_id', Auth::id())
                ->when($request->from_date, fn($q) => $q->whereDate('date', '>=', $request->from_date))
                ->orderBy('date', 'desc')
                ->get();
        } else {
            $reservations = Reservation::with('packageOption') // Eager load the related package options
            ->where('status', 'confirmed')
                ->when($request->to_date, fn($q) => $q->whereDate('date', '<=', $request->to_date))
                ->orderBy('date', 'desc')
                ->get();
        }

        return view('reservations.index', compact('reservations'));
    }

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
        // Fetch the required data from the database
        $packages = PackageOption::all(); // Fetch all package options
        $lanes = Lane::where('is_active', true)->get(); // Fetch active lanes
        $openingTimes = OpeningTime::where('is_active', true)->get(); // Fetch active opening times
        $statuses = ReservationStatus::where('is_active', true)->get(); // Fetch active reservation statuses

        // Pass data to the view
        return view('reservations.create', compact('packages', 'lanes', 'openingTimes', 'statuses'));
    }

    // Store the reservation
    public function store(Request $request)
    {
        // Validate data
        $request->validate([
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'adult_count' => 'required|integer|min:0',
            'child_count' => 'nullable|integer|min:0',
            'package_option' => 'required|exists:package_options,id',
            'lane_id' => 'required|exists:lanes,id',
            'opening_time_id' => 'required|exists:opening_times,id',
            'reservation_status_id' => 'required|exists:reservation_statuses,id',
        ]);

        // Create the reservation
        Reservation::create([
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'adult_count' => $request->adult_count,
            'child_count' => $request->child_count,
            'package_option_id' => $request->package_option,
            'lane_id' => $request->lane_id, // Storing lane_id now
            'opening_time_id' => $request->opening_time_id,
            'reservation_status_id' => $request->reservation_status_id,
            'person_id' => Auth::id(),  // link to authenticated user
            'status' => 'pending',  // set status as pending by default
        ]);

        return redirect()->route('reservations.index')->with('success', 'Reservation created successfully');
    }



}
