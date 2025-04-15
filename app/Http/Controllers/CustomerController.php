<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\PersonType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class CustomerController extends Controller
{
    // Display the customer overview with filtering by date
    public function index(Request $request)
    {
        $customerTypeId = PersonType::where('name', 'customer')->value('id');
    
        $earliestDate = Person::where('person_type_id', $customerTypeId)
            ->orderBy('created_at', 'asc')
            ->value('created_at');
    
        $earliestDate = Carbon::parse($earliestDate)->toDateString();
    
        $customers = Person::with('contact')
            ->where('person_type_id', $customerTypeId)
            ->when($request->date, function($query) use ($request, $earliestDate) {
                $date = Carbon::parse($request->date)->toDateString();
                if ($date < $earliestDate) {
                    return $query->whereRaw('1 = 0');
                }
                return $query->whereDate('created_at', '<=', $date);
            })
            ->orderBy('last_name')
            ->get();
    
        return view('customers.index', compact('customers', 'earliestDate'));
    }

    // Display the form to edit a customer's details
    public function edit($id)
    {
        $customer = Person::findOrFail($id);
        return view('customers.edit', compact('customer'));
    }

    // Handle the update of a customer's details
    public function update(Request $request, $id)
    {
        try {
            // Perform the validation manually
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|unique:contacts,email,' . $id . ',person_id',
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'middle_name' => 'nullable|string|max:255',
                'nickname' => 'nullable|string|max:255',
                'mobile' => 'nullable|string|max:15',
                'is_adult' => 'required|boolean',
            ]);

            // If validation fails, throw a ValidationException
            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            // If validation passes, proceed with the update
            $customer = Person::findOrFail($id);
            $contact = $customer->contact;

            // Update the customer data
            $customer->first_name = $request->input('first_name');
            $customer->middle_name = $request->input('middle_name');
            $customer->last_name = $request->input('last_name');
            $customer->nickname = $request->input('nickname');
            $customer->is_adult = $request->input('is_adult');
            $customer->save();

            // Update the contact data
            $contact->email = $request->input('email');
            $contact->mobile = $request->input('mobile');
            $contact->save();

            // Redirect with a success message
            return redirect()->route('customers.index')->with('success', 'Klantgegevens succesvol gewijzigd.');

        } catch (ValidationException $e) {
            // Handle validation errors by joining the errors into a string
            $errorMessages = implode(", ", array_map(function ($errors) {
                return implode(", ", $errors);
            }, $e->errors()));

            // Redirect with error messages
            return redirect()->route('customers.index')
                ->with('error', 'Er is een fout opgetreden: ' . $errorMessages);
        } catch (\Exception $e) {
            // Handle any other general exceptions
            return redirect()->route('customers.index')->with('error', 'Er is een fout opgetreden: ' . $e->getMessage());
        }
    }    
}
