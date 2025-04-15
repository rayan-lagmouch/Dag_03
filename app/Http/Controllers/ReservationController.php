<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\PackageOption;
use App\Models\Lane;
use App\Models\OpeningTime;
use App\Models\ReservationStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Exception;

class ReservationController extends Controller
{
    /**
     * Toon reserveringsoverzicht voor klant of medewerker
     */
    public function index(Request $request)
    {
        if (Auth::user()->hasRole('customer') && str_starts_with(Auth::user()->name, 'Customer')) {
            $reservations = Reservation::with('packageOption', 'user')->get();
        } else {
            $reservations = Reservation::with(['packageOption', 'lane', 'person', 'status'])
                ->whereHas('status', fn($q) => $q->where('name', 'confirmed'))
                ->when($request->from_date, fn($q) => $q->whereDate('date', '>=', $request->from_date))
                ->orderBy('date', 'desc')
                ->get();
        }

        return view('reservations.index', compact('reservations'));
    }

    /**
     * Bevestigde reserveringen voor medewerkers
     */
    public function confirmed(Request $request)
    {
        $reservations = collect();

        if ($request->filled('to_date')) {
            $reservations = Reservation::with(['person', 'packageOption', 'reservationStatus'])
                ->whereHas('reservationStatus', fn($q) => $q->where('name', 'confirmed'))
                ->whereDate('date', $request->to_date)
                ->orderByDesc('date')
                ->get();
        }

        return view('reservations.confirmed', [
            'reservations' => $reservations,
            'selectedDate' => $request->to_date,
        ]);
    }

    /**
     * Toon formulier voor nieuwe reservering
     */
    public function create()
    {
        $packages = PackageOption::all();
        $lanes = Lane::where('is_active', true)->get();
        $openingTimes = OpeningTime::where('is_active', true)->get();
        $statuses = ReservationStatus::where('is_active', true)->get();

        return view('reservations.create', compact('packages', 'lanes', 'openingTimes', 'statuses'));
    }

    /**
     * Sla nieuwe reservering op
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'date' => 'required|date|after_or_equal:today',
                'start_time' => 'required|date_format:H:i',
                'end_time' => 'required|date_format:H:i|after:start_time',
                'adult_count' => 'required|integer|min:0',
                'child_count' => 'nullable|integer|min:0',
                'package_option' => 'required|exists:package_options,id',
                'lane_id' => 'required|exists:lanes,id',
                'opening_time_id' => 'required|exists:opening_times,id',
                'reservation_status_id' => 'required|exists:reservation_statuses,id',
            ]);

            Reservation::create([
                'date' => $request->date,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'adult_count' => $request->adult_count,
                'child_count' => $request->child_count,
                'package_option_id' => $request->package_option,
                'lane_id' => $request->lane_id,
                'opening_time_id' => $request->opening_time_id,
                'reservation_status_id' => $request->reservation_status_id,
                'person_id' => Auth::id(),
                'is_active' => true,
            ]);

            return redirect()->route('reservations.index')->with('success', 'Reservation created successfully!');
        } catch (Exception $e) {
            Log::error('Fout bij opslaan reservering: ' . $e->getMessage());
            return back()->withErrors(['general' => 'Er ging iets mis bij het opslaan van de reservering. Probeer het opnieuw.']);
        }
    }

    /**
     * Toon formulier voor aanpassen van baan
     */
    public function editLane($id)
    {
        $reservation = Reservation::findOrFail($id);
        return view('reservations.edit-lane', compact('reservation'));
    }

    /**
     * Update de gekozen baan van een reservering
     */
    public function updateLane(Request $request, $id)
    {
        try {
            $reservation = Reservation::findOrFail($id);

            if ($reservation->child_count > 0) {
                $request->validate([
                    'lane_number' => 'required|integer|in:7,8',
                ], [
                    'lane_number.in' => 'You can only select lane 7 or 8 if you have kids due to safety walls.',
                ]);
            } else {
                $request->validate([
                    'lane_number' => 'required|integer|in:1,2,3,4,5,6,7,8',
                ]);
            }

            $reservation->lane_id = $request->lane_number;
            $reservation->save();

            return redirect()->route('reservations.index')->with('success', 'Lane updated successfully');
        } catch (Exception $e) {
            Log::error('Fout bij wijzigen van baan: ' . $e->getMessage());
            return back()->withErrors(['general' => 'Er ging iets mis bij het wijzigen van de baan.']);
        }
    }

    /**
     * Toon formulier voor aanpassen van arrangement
     */
    public function editPackage($id)
    {
        $reservation = Reservation::findOrFail($id);
        $packages = PackageOption::all();
        return view('reservations.edit-package', compact('reservation', 'packages'));
    }

    /**
     * Update het arrangement van een reservering
     */
    public function updatePackage(Request $request, $id)
    {
        try {
            $reservation = Reservation::findOrFail($id);
            $packageOption = PackageOption::findOrFail($request->package_option);

            $notSuitablePackages = ['bachelor_party', 'vrijgezellenfeest'];

            if ($reservation->child_count > 0 && in_array($packageOption->name, $notSuitablePackages)) {
                return back()->withErrors(['package_option' => 'Package "' . $packageOption->name . '" is not suitable for children.']);
            }

            $reservation->package_option_id = $packageOption->id;
            $reservation->save();

            return redirect()->route('reservations.index')->with('success', 'Package option updated');
        } catch (Exception $e) {
            Log::error('Fout bij wijzigen van arrangement: ' . $e->getMessage());
            return back()->withErrors(['general' => 'Er ging iets mis bij het wijzigen van het arrangement.']);
        }
    }
}
