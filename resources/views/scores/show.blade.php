@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    <h2 class="text-2xl font-bold text-blue-700 mb-6">
        🎳 Uitslagen – Reservering #{{ $reservation->id }}
    </h2>

    @if ($scores->isEmpty())
        <div class="bg-blue-50 border border-blue-300 text-blue-800 px-4 py-3 rounded-md shadow-sm flex items-center space-x-2">
            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M13 16h-1v-4h-1m1-4h.01M12 20a8 8 0 100-16 8 8 0 000 16z"/>
            </svg>
            <span>Er zijn nog geen scores beschikbaar voor deze reservering.</span>
        </div>
    @else
        <div class="overflow-x-auto bg-white shadow-sm rounded-lg ring-1 ring-gray-200">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">👤 Speler</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">🎯 Score</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @foreach ($scores as $score)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap text-gray-900">
                                {{ $score->game->person->nickname ?? 'Onbekend' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center font-medium text-blue-600">
                                {{ $score->points }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <div class="mt-6">
        <a href="{{ route('reservations.index') }}"
           class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 transition">
            ⬅️ Terug naar mijn reserveringen
        </a>
    </div>
</div>
@endsection
