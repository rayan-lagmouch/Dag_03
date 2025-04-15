@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-10">
    <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">
        Uitslag Wijzigen - Speler #{{ $score->id }}
    </h1>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6">
            ✅ {{ session('success') }}
        </div>
    @elseif(session('info'))
        <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mb-6">
            ℹ️ {{ session('info') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6">
            <ul class="list-disc ml-5">
                @foreach ($errors->all() as $error)
                    <li>⚠️ {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('scores.update', $score->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow-md max-w-xl mx-auto">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="points" class="block text-sm font-medium text-gray-700">Aantal punten (optioneel)</label>
            <input
                type="number"
                name="points"
                id="points"
                max="300"
                min="0"
                value="{{ old('points', $score->points) }}"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-3 focus:ring-blue-500 focus:border-blue-500"
            >
        </div>

        <div class="flex justify-between mt-6">
            <a href="{{ route('scores.editable') }}" class="inline-block text-blue-600 hover:underline">
                ⬅️ Terug naar overzicht
            </a>

            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md shadow">
                Wijzigen
            </button>
        </div>
    </form>
</div>
@endsection