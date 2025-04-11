<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $customers = Person::whereHas('type', fn($q) => $q->where('name', 'customer'))
            ->when($request->date, fn($q) => $q->whereDate('created_at', '<=', $request->date))
            ->orderBy('last_name')
            ->get();

        if ($customers->isEmpty()) {
            return back()->withErrors(['no_data' => 'No customer information available for this date']);
        }

        return view('customers.index', compact('customers'));
    }
}
