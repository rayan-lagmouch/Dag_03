<!-- resources/views/reservations/edit-lane.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-8">
        <h1 class="text-4xl font-semibold text-center mb-8 text-gray-800">Edit Lane for Reservation #{{ $reservation->id }}</h1>

        <form action="{{ route('reservations.update.lane', $reservation->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow-xl">
            @csrf
            @method('POST')

            <div class="mb-6">
                <label for="lane_number" class="block text-lg font-medium text-gray-700">Select Lane Number</label>
                <select id="lane_number" name="lane_number" class="mt-2 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="7" {{ $reservation->lane_number == 7 ? 'selected' : '' }}>Lane 7</option>
                    <option value="8" {{ $reservation->lane_number == 8 ? 'selected' : '' }}>Lane 8</option>
                </select>
                @error('lane_number')
                <p class="text-red-500 mt-2 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-center mt-6">
                <button type="submit" class="bg-blue-500 text-white px-8 py-3 rounded-md shadow-md hover:bg-blue-600 transition duration-200">Update Lane</button>
            </div>
        </form>
    </div>
@endsection
