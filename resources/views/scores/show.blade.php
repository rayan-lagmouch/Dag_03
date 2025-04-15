@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-10">
    <h2 class="text-2xl font-semibold mb-6">Scores for Reservation #{{ $reservation->id }}</h2>

    @if ($errors->has('score'))
        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-4">
            ⚠️ {{ $errors->first('score') }}
        </div>
    @else
        <table class="min-w-full bg-white shadow rounded">
            <thead class="bg-gray-100">
                <tr>
                    <th class="text-left px-4 py-2">🎳 Player</th>
                    <th class="text-left px-4 py-2">🏆 Score</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($scores as $game)
                    <tr>
                        <td class="px-4 py-2">{{ $game->person->nickname ?? 'Unknown' }}</td>
                        <td class="px-4 py-2">{{ $game->score->points ?? 'No score yet' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('reservations.index') }}" class="inline-block mt-6 text-blue-600 hover:underline">← Back to reservations</a>
</div>
@endsection
