@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-10">

    @if ($errors->has('score'))
        <div class="bg-yellow-100 text-yellow-800 border-l-4 border-yellow-500 p-4 mb-4">
            ⚠️ {{ $errors->first('score') }}
        </div>
    @endif

    <!-- Filter op vanaf datum -->
    <div class="flex flex-col md:flex-row md:justify-between items-center mb-6 gap-4">
        <div>
            <label for="from_date" class="block text-sm text-gray-600">Toon reserveringen vanaf:</label>
            <input type="date" id="from_date"
                class="border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>
        <div class="mt-6 md:mt-0">
            <button type="button" onclick="filterReservations()" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition shadow">
                Toon reserveringen
            </button>
        </div>
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
                            <td class="px-6 py-4" data-date="{{ \Carbon\Carbon::parse($reservation->date)->format('Y-m-d') }}">
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
                            <td class="px-6 py-4 space-y-2">
                                <a href="{{ route('reservations.edit-lane', $reservation->id) }}" class="text-blue-500 hover:text-blue-700 underline block">
                                    Baan wijzigen
                                </a>
                                <a href="{{ route('scores.show', $reservation->id) }}" class="text-green-600 hover:text-green-800 underline block">
                                    Bekijk Uitslagen
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <!-- Pop-ups -->
    <div id="success-popup" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 hidden">
        <div class="bg-white rounded-xl shadow-lg p-6 w-full max-w-md text-center">
            <h2 class="text-xl font-bold text-green-600 mb-2">✅ Gelukt!</h2>
            <p class="text-gray-600">De baan is succesvol aangepast.</p>
            <button id="close-popup" class="mt-4 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Sluiten</button>
        </div>
    </div>

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

        function filterReservations() {
            const fromDate = document.getElementById('from_date').value;
            const rows = document.querySelectorAll('tbody tr');

            if (!fromDate) {
                rows.forEach(row => row.style.display = 'table-row');
                return;
            }

            const selectedDate = new Date(fromDate);
            selectedDate.setHours(0, 0, 0, 0);

            rows.forEach(row => {
                const cell = row.querySelector('td[data-date]');
                if (!cell) return;

                const rowDateStr = cell.getAttribute('data-date');
                const rowDate = new Date(rowDateStr);
                rowDate.setHours(0, 0, 0, 0);

                if (rowDate >= selectedDate) {
                    row.style.display = 'table-row';
                } else {
                    row.style.display = 'none';
                }
            });
        }
    </script>
</div>
@endsection
