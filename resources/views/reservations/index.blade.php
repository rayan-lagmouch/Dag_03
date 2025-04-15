@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-10">

    {{-- Error Message for Missing Scores --}}
    @if ($errors->has('score'))
        <div class="bg-yellow-100 text-yellow-800 border-l-4 border-yellow-500 p-4 mb-4">
            ⚠️ {{ $errors->first('score') }}
        </div>
    @endif

    {{-- Filter by Start Date --}}
    <div class="flex flex-col md:flex-row md:justify-between items-center mb-6 gap-4">
        <div>
            <label for="from_date" class="block text-sm text-gray-600">Show reservations from:</label>
            <input type="date" id="from_date"
                class="border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>
        <div class="mt-6 md:mt-0">
            <button type="button" onclick="filterReservations()" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition shadow">
                Show Reservations
            </button>
        </div>
    </div>

    {{-- If No Reservations --}}
    @if ($reservations->isEmpty())
        <div class="text-center text-gray-500 text-lg mt-10">You haven't made any reservations yet.</div>
    @else
        {{-- Reservation Table --}}
        <div class="overflow-x-auto bg-white rounded-xl shadow ring-1 ring-gray-200">
            <table class="min-w-full text-sm text-gray-700">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-4 text-left font-semibold">👤 Name</th>
                        <th class="px-6 py-4 text-left font-semibold">📅 Date</th>
                        <th class="px-6 py-4 text-left font-semibold">🏷️ Lane</th>
                        <th class="px-6 py-4 text-left font-semibold">🎁 Package</th>
                        <th class="px-6 py-4 text-left font-semibold">⏰ Start Time</th>
                        <th class="px-6 py-4 text-left font-semibold">⏱️ End Time</th>
                        <th class="px-6 py-4 text-left font-semibold">⏳ Hours</th>
                        <th class="px-6 py-4 text-left font-semibold">👨 Adults</th>
                        <th class="px-6 py-4 text-left font-semibold">🧒 Children</th>
                        <th class="px-6 py-4 text-left font-semibold">⚙️ Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reservations as $reservation)
                        <tr class="hover:bg-gray-50 transition duration-200">
                            <td class="px-6 py-4">
                                {{ $reservation->person ? $reservation->person->first_name . ' ' . $reservation->person->last_name : 'No name' }}
                            </td>
                            <td class="px-6 py-4" data-date="{{ \Carbon\Carbon::parse($reservation->date)->format('Y-m-d') }}">
                                {{ \Carbon\Carbon::parse($reservation->date)->translatedFormat('l d F Y') }}
                            </td>
                            <td class="px-6 py-4">{{ $reservation->lane->number ?? 'Not assigned' }}</td>
                            <td class="px-6 py-4">{{ $reservation->packageOption->name ?? 'None' }}</td>
                            <td class="px-6 py-4">{{ \Carbon\Carbon::parse($reservation->start_time)->format('H:i') }}</td>
                            <td class="px-6 py-4">{{ \Carbon\Carbon::parse($reservation->end_time)->format('H:i') }}</td>
                            <td class="px-6 py-4">
                                {{ \Carbon\Carbon::parse($reservation->start_time)->diffInHours(\Carbon\Carbon::parse($reservation->end_time)) }} hour(s)
                            </td>
                            <td class="px-6 py-4">{{ $reservation->adult_count }}</td>
                            <td class="px-6 py-4">{{ $reservation->child_count }}</td>
                            <td class="px-6 py-4 space-y-2">
                                <a href="{{ route('reservations.edit-lane', $reservation->id) }}" class="text-blue-500 hover:text-blue-700 underline block">
                                    Change Lane
                                </a>

                                <a href="{{ route('reservations.edit.package', $reservation->id) }}" class="text-purple-600 hover:text-purple-800 underline block">
                                    Change Package
                                </a>

                                <a href="{{ route('scores.show', $reservation->id) }}" class="text-green-600 hover:text-green-800 underline block">
                                    View Scores
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    {{-- Success Popup --}}
    <div id="success-popup" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 hidden">
        <div class="bg-white rounded-xl shadow-lg p-6 w-full max-w-md text-center">
            <h2 class="text-xl font-bold text-green-600 mb-2">✅ Success!</h2>
            <p class="text-gray-600">The lane has been successfully updated.</p>
            <button id="close-popup" class="mt-4 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Close</button>
        </div>
    </div>

    {{-- Warning Popup --}}
    <div id="warning-popup" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-xl shadow-lg p-6 w-full max-w-md text-center">
            <h2 class="text-xl font-bold text-red-600 mb-2">⚠️ Attention!</h2>
            <p class="text-gray-600">There are children in the group. Please select a lane with fences (7 or 8).</p>
            <button id="close-warning-popup" class="mt-4 bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg">Close</button>
        </div>
    </div>

    {{-- JavaScript --}}
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
