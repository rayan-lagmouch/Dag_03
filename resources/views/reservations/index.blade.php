<!-- resources/views/reservations/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-8">
        <h1 class="text-4xl font-semibold text-center mb-8 text-gray-800">Your Reservations</h1>

        @if($reservations->isEmpty())
            <div class="text-center text-gray-600">You don't have any reservations yet!</div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($reservations as $reservation)
                    <div class="bg-white rounded-lg shadow-xl p-6 hover:shadow-2xl transform hover:scale-105 transition-all duration-300">
                        <h2 class="text-xl font-semibold text-gray-700">{{ $reservation->date->format('l, F j, Y') }}</h2>
                        <p class="text-gray-500">Lane: {{ $reservation->lane_number }}</p>
                        <p class="text-gray-500">Package: {{ $reservation->package_option ? $reservation->package_option->name : 'None' }}</p>

                        <div class="flex items-center justify-between mt-4">
                            <a href="{{ route('reservations.edit.lane', $reservation->id) }}" class="bg-blue-500 text-white py-2 px-4 rounded-md shadow-md hover:bg-blue-600 transition duration-200">Edit Lane</a>
                            <a href="{{ route('reservations.edit.package', $reservation->id) }}" class="bg-green-500 text-white py-2 px-4 rounded-md shadow-md hover:bg-green-600 transition duration-200">Edit Package</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
