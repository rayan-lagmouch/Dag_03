<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        // Get customers of type 'customer' and filter by date if available
        $customers = Person::whereHas('type', fn($q) => $q->where('name', 'customer'))
            ->when($request->date, fn($q) => $q->whereDate('created_at', '<=', Carbon::parse($request->date)->format('Y-m-d')))
            ->orderBy('last_name')
            ->get();

        // Check if no customers were found
        if ($customers->isEmpty()) {
            return back()->withErrors(['no_data' => 'No customer information available for this date']);
        }

        // Return the view with the customers data
        return view('customers.index', compact('customers'));
    }
}
