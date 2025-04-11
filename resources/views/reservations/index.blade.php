@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-10 px-4">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Mijn Reserveringen</h2>

    @if ($reservations->isEmpty())
        <div class="bg-yellow-100 text-yellow-800 p-4 rounded-md shadow-sm">
            Je hebt nog geen reserveringen.
        </div>
    @else
        <div class="overflow-x-auto bg-white shadow ring-1 ring-gray-200 rounded-lg">
            <table class="min-w-full divide-y divide-gray-100">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Datum</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Begintijd</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Eindtijd</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Volwassenen</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Kinderen</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Uitslagen</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @foreach ($reservations as $reservation)
                        <tr>
                            <td class="px-6 py-4">{{ $reservation->date }}</td>
                            <td class="px-6 py-4">{{ $reservation->start_time }}</td>
                            <td class="px-6 py-4">{{ $reservation->end_time }}</td>
                            <td class="px-6 py-4">{{ $reservation->num_adults }}</td>
                            <td class="px-6 py-4">{{ $reservation->num_children ?? '-' }}</td>
                            <td class="px-6 py-4">
                            <a href="{{ route('scores.show', ['reservation' => $reservation->id]) }}">Bekijk uitslagen</a>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
