<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        // Use the correct column name: person_type_id
        $customers = Person::where('person_type_id', 'customer') // Still needs fix: 'customer' isn't an ID
            ->when($request->date, fn($q) => $q->whereDate('created_at', '<=', Carbon::parse($request->date)->format('Y-m-d')))
            ->orderBy('last_name')
            ->get();
    
        if ($customers->isEmpty()) {
            return back()->withErrors(['no_data' => 'No customer information available for this date']);
        }
    
        return view('customers.index', compact('customers'));
    }
    
}
