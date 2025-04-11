<!-- resources/views/reservations/create.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-8">
        <h1 class="text-4xl font-semibold text-center mb-8 text-gray-800">Create New Reservation</h1>

        <form action="{{ route('reservations.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-xl">
            @csrf

            <!-- Date Picker -->
            <div class="mb-6">
                <label for="date" class="block text-lg font-medium text-gray-700">Reservation Date</label>
                <input type="date" id="date" name="date" class="mt-2 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('date') }}">
                @error('date')
                <p class="text-red-500 mt-2 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Lane Selection -->
            <div class="mb-6">
                <label for="lane_number" class="block text-lg font-medium text-gray-700">Select Lane Number</label>
                <select id="lane_number" name="lane_number" class="mt-2 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="7" {{ old('lane_number') == 7 ? 'selected' : '' }}>Lane 7</option>
                    <option value="8" {{ old('lane_number') == 8 ? 'selected' : '' }}>Lane 8</option>
                </select>
                @error('lane_number')
                <p class="text-red-500 mt-2 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Package Option Selection -->
            <div class="mb-6">
                <label for="package_option" class="block text-lg font-medium text-gray-700">Select Package Option</label>
                <select id="package_option" name="package_option" class="mt-2 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="" disabled {{ old('package_option') ? '' : 'selected' }}>Choose a package</option>
                    @foreach($packages as $package)
                        <option value="{{ $package->id }}" {{ old('package_option') == $package->id ? 'selected' : '' }}>{{ $package->name }}</option>
                    @endforeach
                </select>
                @error('package_option')
                <p class="text-red-500 mt-2 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex justify-center mt-6">
                <button type="submit" class="bg-blue-500 text-white px-8 py-3 rounded-md shadow-md hover:bg-blue-600 transition duration-200">Create Reservation</button>
            </div>
        </form>
    </div>
@endsection
