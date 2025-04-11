@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-8">
        <h1 class="text-4xl font-semibold text-center mb-8 text-gray-800">Edit Package for Reservation #{{ $reservation->id }}</h1>

        <form action="{{ route('reservations.update-package', $reservation->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow-xl">
            @csrf
            @method('POST') <!-- Changed to POST, since we're updating a resource -->

            <div class="mb-6">
                <label for="package_option" class="block text-lg font-medium text-gray-700">Select Package Option</label>
                <select id="package_option" name="package_option" class="mt-2 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="" disabled {{ !$reservation->package_option ? 'selected' : '' }}>Choose a package</option>
                    @foreach($packages as $package)
                        <option value="{{ $package->id }}" {{ $reservation->package_option_id == $package->id ? 'selected' : '' }}>
                            {{ $package->name }}
                        </option>
                    @endforeach
                </select>
                @error('package_option')
                <p class="text-red-500 mt-2 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-center mt-6">
                <button type="submit" class="bg-green-500 text-white px-8 py-3 rounded-md shadow-md hover:bg-green-600 transition duration-200">Update Package</button>
            </div>
        </form>
    </div>
@endsection
