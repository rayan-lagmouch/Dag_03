@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto py-6">
        <h1 class="text-2xl font-semibold text-center mb-6">Create Reservation</h1>

        <form action="{{ route('reservations.store') }}" method="POST" class="bg-white shadow-lg rounded-lg p-6">
            @csrf

            {{-- Reservation Date --}}
            <div class="mb-4">
                <label for="date" class="block text-gray-700">Date</label>
                <input type="date" name="date" id="date" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            {{-- Start Time --}}
            <div class="mb-4">
                <label for="start_time" class="block text-gray-700">Start Time</label>
                <input type="time" name="start_time" id="start_time" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            {{-- End Time --}}
            <div class="mb-4">
                <label for="end_time" class="block text-gray-700">End Time</label>
                <input type="time" name="end_time" id="end_time" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            {{-- Number of Adults --}}
            <div class="mb-4">
                <label for="adult_count" class="block text-gray-700">Number of Adults</label>
                <input type="number" name="adult_count" id="adult_count" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required min="1">
            </div>

            {{-- Number of Children --}}
            <div class="mb-4">
                <label for="child_count" class="block text-gray-700">Number of Children</label>
                <input type="number" name="child_count" id="child_count" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required min="0">
            </div>

            {{-- Package Option --}}
            <div class="mb-4">
                <label for="package_option" class="block text-gray-700">Package Option</label>
                <select name="package_option" id="package_option" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    <option value="snackpacketbasis">Snack Packet Basic</option>
                    <option value="snackpakketluxe">Snack Packet Deluxe</option>
                    <option value="kinderpartij">Children's Party</option>
                    <option value="vrijgezellenfeest">Bachelor Party</option>
                </select>
            </div>

            {{-- Lane Selection --}}
            <div class="mb-4">
                <label for="lane_id" class="block text-gray-700">Lane</label>
                <select name="lane_id" id="lane_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    @foreach ($lanes as $lane)
                        <option value="{{ $lane->id }}">
                            Lane {{ $lane->number }} (Has Fence: {{ $lane->has_fence ? 'Yes' : 'No' }})
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Opening Time Slot --}}
            <div class="mb-4">
                <label for="opening_time_id" class="block text-gray-700">Opening Time</label>
                <select name="opening_time_id" id="opening_time_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    @foreach ($openingTimes as $openingTime)
                        <option value="{{ $openingTime->id }}">
                            {{ $openingTime->day_name }} - {{ $openingTime->start_time }} to {{ $openingTime->end_time }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Reservation Status --}}
            <div class="mb-4">
                <label for="reservation_status_id" class="block text-gray-700">Reservation Status</label>
                <select name="reservation_status_id" id="reservation_status_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    @foreach ($statuses as $status)
                        <option value="{{ $status->id }}">{{ $status->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Submit Button --}}
            <div class="flex justify-center">
                <button type="submit" class="bg-blue-500 text-white rounded-md py-2 px-6 mt-4 hover:bg-blue-600">
                    Create Reservation
                </button>
            </div>
        </form>
    </div>
@endsection
