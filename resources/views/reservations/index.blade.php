@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-10">
    <h1 class="text-3xl font-bold text-center text-blue-800 mb-8">🎳 Mijn Reserveringen</h1>

    <!-- Filter & Sorteer sectie -->
    <div class="flex flex-col md:flex-row md:justify-between items-center mb-6 gap-4">
        <div class="flex items-center">
            <label for="reservation-sort" class="mr-2 text-sm text-gray-600">Sorteer op datum:</label>
            <select id="reservation-sort" class="border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-md shadow-sm">
                <option value="desc" selected>Nieuwste eerst</option>
                <option value="asc">Oudste eerst</option>
            </select>
        </div>
        <button id="sort-btn" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition shadow">
            Sorteer reserveringen
        </button>
    </div>

    @if ($reservations->isEmpty())
        <div class="text-center text-gray-500 text-lg mt-10">Je hebt nog geen reserveringen geplaatst.</div>
    @else
        <div class="overflow-x-auto bg-white rounded-xl shadow ring-1 ring-gray-200">
            <table class="min-w-full text-sm text-gray-700">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-4 text-left font-semibold">👤 Naam</th>
                        <th class="px-6 py-4 text-left font-semibold">📅 Datum</th>
                        <th class="px-6 py-4 text-left font-semibold">🏷️ Baan</th>
                        <th class="px-6 py-4 text-left font-semibold">🎁 Arrangement</th>
                        <th class="px-6 py-4 text-left font-semibold">⏰ Starttijd</th>
                        <th class="px-6 py-4 text-left font-semibold">⏱️ Eindtijd</th>
                        <th class="px-6 py-4 text-left font-semibold">⏳ Uren</th>
                        <th class="px-6 py-4 text-left font-semibold">👨 Volwassenen</th>
                        <th class="px-6 py-4 text-left font-semibold">🧒 Kinderen</th>
                        <th class="px-6 py-4 text-left font-semibold">⚙️ Actie</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reservations as $reservation)
                        <tr class="hover:bg-gray-50 transition duration-200">
                            <td class="px-6 py-4">
                                {{ $reservation->person ? $reservation->person->first_name . ' ' . $reservation->person->last_name : 'Geen naam' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ \Carbon\Carbon::parse($reservation->date)->format('l d F Y') }}
                            </td>
                            <td class="px-6 py-4">{{ $reservation->lane->number ?? 'Niet toegewezen' }}</td>
                            <td class="px-6 py-4">{{ $reservation->packageOption->name ?? 'Geen' }}</td>
                            <td class="px-6 py-4">{{ \Carbon\Carbon::parse($reservation->start_time)->format('H:i') }}</td>
                            <td class="px-6 py-4">{{ \Carbon\Carbon::parse($reservation->end_time)->format('H:i') }}</td>
                            <td class="px-6 py-4">
                                {{ \Carbon\Carbon::parse($reservation->start_time)->diffInHours(\Carbon\Carbon::parse($reservation->end_time)) }} uur
                            </td>
                            <td class="px-6 py-4">{{ $reservation->adult_count }}</td>
                            <td class="px-6 py-4">{{ $reservation->child_count }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('reservations.edit-lane', $reservation->id) }}" class="text-blue-500 hover:text-blue-700 underline">Baan wijzigen</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <!-- Geen reserveringen in geselecteerde periode -->
    <div id="no-reservations-message" class="text-center text-gray-500 mt-6 hidden">
        Geen reserveringen in deze periode.
    </div>

    <!-- Succes Pop-up -->
    <div id="success-popup" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 hidden">
        <div class="bg-white rounded-xl shadow-lg p-6 w-full max-w-md text-center">
            <h2 class="text-xl font-bold text-green-600 mb-2">✅ Gelukt!</h2>
            <p class="text-gray-600">De baan is succesvol aangepast.</p>
            <button id="close-popup" class="mt-4 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Sluiten</button>
        </div>
    </div>

    <!-- Waarschuwing Pop-up -->
    <div id="warning-popup" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-xl shadow-lg p-6 w-full max-w-md text-center">
            <h2 class="text-xl font-bold text-red-600 mb-2">⚠️ Let op!</h2>
            <p class="text-gray-600">Je hebt kinderen in de groep. Kies een baan met hekjes (7 of 8).</p>
            <button id="close-warning-popup" class="mt-4 bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg">Sluiten</button>
        </div>
    </div>

    <script>
        function showSuccessPopup() {
            document.getElementById('success-popup').classList.remove('hidden');
        }

        function showWarningPopup() {
            document.getElementById('warning-popup').classList.remove('hidden');
        }

        document.getElementById('close-popup')?.addEventListener('click', () => {
            document.getElementById('success-popup').classList.add('hidden');
        });

        document.getElementById('close-warning-popup')?.addEventListener('click', () => {
            document.getElementById('warning-popup').classList.add('hidden');
        });

        @if(session('success'))
            showSuccessPopup();
        @endif
    </script>
</div>
@endsection
