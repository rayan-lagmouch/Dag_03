@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">Score Overview per Reservation</h1>

    @forelse($reservations as $reservation)
        <div class="mb-6 p-4 bg-white rounded shadow">
            <h2 class="text-lg font-semibold mb-2">Reservation #{{ $reservation->id }} - {{ $reservation->person->first_name ?? 'Unknown' }}</h2>
            <ul class="space-y-1">
                @foreach ($reservation->games as $game)
                    <li>
                        {{ $game->person->nickname ?? 'Player' }} - {{ $game->score->points ?? 'No score' }}
                    </li>
                @endforeach
            </ul>
        </div>
    @empty
        <p>No scores available.</p>
    @endforelse
</div>
@endsection
