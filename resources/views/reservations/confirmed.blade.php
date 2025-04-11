@extends('layouts.app')

@section('content')
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-2xl p-6">
                <h2 class="text-2xl font-bold mb-6">Confirmed Reservations Overview</h2>

                {{-- Filter Form --}}
                <form method="GET" action="{{ route('reservations.confirmed') }}" class="mb-6 flex items-center space-x-4">
                    <div>
                        <label for="to_date" class="block text-sm font-medium text-gray-700">Select a date</label>
                        <input type="date" name="to_date" id="to_date"
                               value="{{ old('to_date', $selectedDate) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div class="pt-5">
                        <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700">
                            Show
                        </button>
                    </div>
                </form>

                {{-- Show Reservations or Message --}}
                @if($reservations->count() > 0)
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Customer Name</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Date</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Start Time</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">End Time</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Lane</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Package</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                        @foreach($reservations as $reservation)
                            <tr>
                                <td class="px-4 py-2 text-sm text-gray-700">
                                    {{ $reservation->person->first_name }} {{ $reservation->person->last_name }}
                                </td>
                                <td class="px-4 py-2 text-sm text-gray-700">{{ $reservation->date }}</td>
                                <td class="px-4 py-2 text-sm text-gray-700">{{ $reservation->start_time }}</td>
                                <td class="px-4 py-2 text-sm text-gray-700">{{ $reservation->end_time }}</td>
                                <td class="px-4 py-2 text-sm text-gray-700">{{ $reservation->lane_id }}</td>
                                <td class="px-4 py-2 text-sm text-gray-700">{{ $reservation->packageOption->name ?? 'None' }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="text-red-600 text-md font-semibold mt-4">
                        No reservation information available for the selected date.
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
