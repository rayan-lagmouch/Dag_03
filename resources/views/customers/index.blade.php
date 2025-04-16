@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-6">
        <div class="bg-white p-6 rounded-xl shadow-md">
            <h1 class="text-2xl font-bold mb-4">Customer Overview</h1>

            {{-- Display Error Message --}}
            @if(session('error'))
                <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                    <strong>Error!</strong> {{ session('error') }}
                </div>
            @endif

            {{-- Date Filter Form --}}
            <form method="GET" action="{{ route('customers.index') }}" class="mb-6 flex items-center gap-4">
                <label for="date" class="text-sm font-medium text-gray-700">Select Date (Registration Date Until):</label>
                <input type="text" id="date" name="date" value="{{ old('date', request('date')) }}" class="border rounded p-2 text-sm w-40" placeholder="YYYY-MM-DD" />
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Filter
                </button>
            </form>

            {{-- Customer Table --}}
            <div class="overflow-x-auto">
                @if($customers->isEmpty())
                    <div class="text-center py-6">No information is available for the selected date.</div>
                @else
                    <table class="min-w-full table-auto border border-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left">Name</th>
                                <th class="px-4 py-2 text-left">Mobile</th>
                                <th class="px-4 py-2 text-left">Email</th>
                                <th class="px-4 py-2 text-left">Adult</th>
                                <th class="px-4 py-2 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($customers as $customer)
                                <tr class="border-t">
                                    <td class="px-4 py-2">{{ $customer->first_name . ' ' . $customer->last_name }}</td>
                                    <td class="px-4 py-2">{{ optional($customer->contact)->mobile ?? '—' }}</td>
                                    <td class="px-4 py-2">{{ optional($customer->contact)->email ?? '—' }}</td>
                                    <td class="px-4 py-2">{{ $customer->is_adult ? 'Yes' : 'No' }}</td>
                                    <td class="px-4 py-2">
                                        <a href="{{ route('customers.edit', $customer->id) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection
