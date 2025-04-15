@extends('layouts.app')

@section('content')
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-2xl p-6">
                <h2 class="text-2xl font-bold mb-4">Dashboard</h2>

                <p class="text-gray-600 mb-6">
                    Welcome, {{ auth()->user()->name }} (Role: {{ auth()->user()->getRoleNames()->first() }})
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @role('customer')
                    <x-dashboard-link route="reservations.index" label="My Reservations" />
                    <x-dashboard-link route="scores.show" label="View Scores" />
                    @endrole

                    @role('employee')
                    <x-dashboard-link route="reservations.confirmed" label="Confirmed Reservations" />
                    <x-dashboard-link route="customers.index" label="Customer Overview" />
                    <x-dashboard-link route="scores.editable" label="Edit Scores" />
                    <x-dashboard-link route="contacts.index" label="Update Contact Info" />
                    @endrole
                </div>
            </div>
        </div>
    </div>
@endsection
