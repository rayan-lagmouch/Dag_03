<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\PersonType;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CustomerController extends Controller
{
    // Display the customer overview with filtering by date
    public function index(Request $request)
    {
        // Verkrijg het person_type_id voor "customer"
        $customerTypeId = PersonType::where('name', 'customer')->value('id');
    
        // Verkrijg de eerste datum in de database (de oudste klantregistratie)
        $earliestDate = Person::where('person_type_id', $customerTypeId)
            ->orderBy('created_at', 'asc')
            ->value('created_at');
    
        // Zorg ervoor dat de datums zonder tijd worden vergeleken
        $earliestDate = Carbon::parse($earliestDate)->toDateString();
    
        // Haal klanten op met hun contactgegevens, gefilterd op datum
        $customers = Person::with('contact') // Eager load de contactrelatie
            ->where('person_type_id', $customerTypeId)
            ->when($request->date, function($query) use ($request, $earliestDate) {
                $date = Carbon::parse($request->date)->toDateString(); // Verwijder tijd
                if ($date < $earliestDate) {
                    return $query->whereRaw('1 = 0'); // Geen klanten ophalen als de datum te vroeg is
                }
                return $query->whereDate('created_at', '<=', $date);  // Gebruik whereDate voor correcte datumvergelijking
            })
            ->orderBy('last_name') // Sorteer op achternaam alfabetisch
            ->get();
    
        // Geef de klanten door naar de view
        return view('customers.index', compact('customers', 'earliestDate'));
    }
    
    
    
    
    
    
    
    // Display the form to edit a customer's details
    public function edit($id)
    {
        // Find the customer by ID
        $customer = Person::findOrFail($id);
        
        // Pass the customer data to the edit view
        return view('customers.edit', compact('customer'));
    }

    // Handle the update of a customer's email
    public function update(Request $request, $id)
    {
        // Validate the input data
        $request->validate([
            'email' => 'required|email|unique:contacts,email,' . $id . ',person_id',  // Ensure the email is unique for the person
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'nickname' => 'nullable|string|max:255',
            'mobile' => 'nullable|string|max:15',
            'is_adult' => 'required|boolean',
        ]);
    
        // Find the customer and their contact info
        $customer = Person::findOrFail($id);
        $contact = $customer->contact;
    
        // Update the customer data
        $customer->first_name = $request->input('first_name');
        $customer->middle_name = $request->input('middle_name');
        $customer->last_name = $request->input('last_name');
        $customer->nickname = $request->input('nickname');
        $customer->is_adult = $request->input('is_adult');
        $customer->save();  // Save the updated customer info
    
        // Update the contact info
        $contact->email = $request->input('email');
        $contact->mobile = $request->input('mobile');
        $contact->save();  // Save the updated contact info
    
        // Redirect back to the customer overview with a success message
        return redirect()->route('customers.index')->with('success', 'Klantgegevens succesvol gewijzigd.');
    }
    
}
