@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-8">
        <h1 class="text-4xl font-semibold text-center mb-8 text-gray-800">Your Reservations</h1>

        <!-- Date Filter and Sorting Dropdown -->
        <div class="flex justify-between items-center mb-4">
            <div class="flex items-center">
                <label for="reservation-sort" class="mr-2 text-gray-600">Sort by Date:</label>
                <select id="reservation-sort" class="p-2 border rounded">
                    <option value="desc" selected>Newest to Oldest</option>
                    <option value="asc">Oldest to Newest</option>
                </select>
            </div>
            <button id="sort-btn" class="bg-blue-500 text-white py-2 px-6 rounded-md shadow-md hover:bg-blue-600">Sort Reservations</button>
        </div>

        <!-- No Reservations Message -->
        <div id="no-reservations-message" class="text-center text-gray-600 hidden">No information in this period</div>

        @if($reservations->isEmpty())
            <div class="text-center text-gray-600">You don't have any reservations yet!</div>
        @else
            <!-- Table to Display Reservations -->
            <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-xl">
                <thead>
                <tr class="bg-gray-100 text-gray-700">
                    <th class="py-2 px-4 border-b">Name</th>
                    <th class="py-2 px-4 border-b">Date</th>
                    <th class="py-2 px-4 border-b">Lane</th>
                    <th class="py-2 px-4 border-b">Package</th>
                    <th class="py-2 px-4 border-b">Start Time</th>
                    <th class="py-2 px-4 border-b">End Time</th>
                    <th class="py-2 px-4 border-b">Hours</th>
                    <th class="py-2 px-4 border-b">Adults</th>
                    <th class="py-2 px-4 border-b">Kids</th>

                </tr>
                </thead>
                <tbody id="reservation-table-body">
                @foreach($reservations as $reservation)
                    <tr class="text-gray-600 reservation-row" data-reservation-date="{{ $reservation->date }}">
                        <td class="py-2 px-4 border-b">{{ $reservation->person ? $reservation->person->first_name . ' ' . $reservation->person->last_name : 'No Name Found' }}</td>
                        <td class="py-2 px-4 border-b">{{ \Carbon\Carbon::parse($reservation->date)->format('l, F j, Y') }}</td>
                        <td class="py-2 px-4 border-b">{{ $reservation->lane ? $reservation->lane->number : 'No Lane Assigned' }}</td>
                        <td class="py-2 px-4 border-b">{{ $reservation->packageOption ? $reservation->packageOption->name : 'None' }}</td>
                        <td class="py-2 px-4 border-b">{{ \Carbon\Carbon::parse($reservation->start_time)->format('H:i') }}</td>
                        <td class="py-2 px-4 border-b">{{ \Carbon\Carbon::parse($reservation->end_time)->format('H:i') }}</td>
                        <td class="py-2 px-4 border-b">{{ \Carbon\Carbon::parse($reservation->start_time)->diffInHours(\Carbon\Carbon::parse($reservation->end_time)) }} hours</td>
                        <td class="py-2 px-4 border-b">{{ $reservation->adult_count }}</td>
                        <td class="py-2 px-4 border-b">{{ $reservation->child_count }}</td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <script>
        // JavaScript for sorting reservations by date (ascending or descending)
        document.getElementById('sort-btn').addEventListener('click', function() {
            let selectedSortOrder = document.getElementById('reservation-sort').value;
            let rows = document.querySelectorAll('.reservation-row');
            let noReservationsMessage = document.getElementById('no-reservations-message');
            let visibleRows = 0;

            // Sort the rows by date in ascending or descending order based on the selected option
            let tableBody = document.getElementById('reservation-table-body');
            let rowsArray = Array.from(rows);

            rowsArray.sort((a, b) => {
                let dateA = a.getAttribute('data-reservation-date');
                let dateB = b.getAttribute('data-reservation-date');

                // Compare the dates for sorting based on selected order
                if (selectedSortOrder === 'asc') {
                    return new Date(dateA) - new Date(dateB); // Oldest first
                } else {
                    return new Date(dateB) - new Date(dateA); // Newest first
                }
            });

            // Append the sorted rows back to the table
            rowsArray.forEach(row => {
                tableBody.appendChild(row);
            });

            // Show "No information in this period" message if no rows are visible
            rowsArray.forEach(row => {
                let date = row.querySelector('td').innerText; // Get the date from the first column
                if (date) {
                    visibleRows++;
                }
            });

            if (visibleRows === 0) {
                noReservationsMessage.style.display = 'block';
            } else {
                noReservationsMessage.style.display = 'none';
            }
        });
    </script>
@endsection
