@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">Score Overzicht per Reservering</h1>

    @forelse($reservations as $reservation)
        <div class="mb-6 p-4 bg-white rounded shadow">
            <h2 class="text-lg font-semibold mb-2">Reservering #{{ $reservation->id }} - {{ $reservation->person->first_name ?? 'Onbekend' }}</h2>
            <ul class="space-y-1">
                @foreach ($reservation->games as $game)
                    <li>
                        {{ $game->person->nickname ?? 'Speler' }} - {{ $game->score->points ?? 'Geen score' }}
                    </li>
                @endforeach
            </ul>
        </div>
    @empty
        <p>Geen scores beschikbaar.</p>
    @endforelse
</div>
@endsection
