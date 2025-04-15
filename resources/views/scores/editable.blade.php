@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl text-white font-bold mb-6">All Editable Scores</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full bg-white shadow rounded text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2">Player</th>
                <th class="px-4 py-2">Score</th>
                <th class="px-4 py-2">Reservation</th>
                <th class="px-4 py-2">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($scores as $score)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $score->game->person->nickname ?? 'Unknown' }}</td>
                    <td class="px-4 py-2">{{ $score->points }}</td>
                    <td class="px-4 py-2">#{{ $score->game->reservation->id }}</td>
                    <td class="px-4 py-2">
                        <a href="{{ route('scores.edit', $score->id) }}" class="text-blue-500 underline">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
