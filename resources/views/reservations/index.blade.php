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
            <div class="overflow-x-auto">
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
                        <th class="py-2 px-4 border-b">Actions</th>
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
                            <td class="py-2 px-4 border-b">
                                <a href="{{ route('reservations.edit-lane', $reservation->id) }}" class="text-blue-500 hover:text-blue-700">Edit Lane</a>

                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <!-- Success Popup (Tailwind) -->
    <div id="success-popup" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-md shadow-lg">
            <h2 class="text-lg font-semibold text-green-600">Success!</h2>
            <p class="mt-2 text-gray-600">Lane updated successfully.</p>
            <button id="close-popup" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Close</button>
        </div>
    </div>

    <!-- Warning Popup (Tailwind) -->
    <div id="warning-popup" class="fixed inset-0 flex items-center justify-center bg-red-800 bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-md shadow-lg">
            <h2 class="text-lg font-semibold text-red-600">Warning!</h2>
            <p class="mt-2 text-gray-600">You have children in your group, so you must choose a lane with safety fences (7 or 8).</p>
            <button id="close-warning-popup" class="mt-4 bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">Close</button>
        </div>
    </div>

    <script>
        // Show success popup on lane update
        function showSuccessPopup() {
            document.getElementById('success-popup').classList.remove('hidden');
        }

        // Close the success popup
        document.getElementById('close-popup').addEventListener('click', function() {
            document.getElementById('success-popup').classList.add('hidden');
        });

        // Show warning popup if user has children and selects a lane other than 7 or 8
        function showWarningPopup() {
            document.getElementById('warning-popup').classList.remove('hidden');
        }

        // Close the warning popup
        document.getElementById('close-warning-popup').addEventListener('click', function() {
            document.getElementById('warning-popup').classList.add('hidden');
        });

        // Trigger success popup after updating lane
        @if(session('success'))
        showSuccessPopup();
        @endif

        // Handle form submission for lane change
        document.getElementById('reservation-form').addEventListener('submit', function(e) {
            const laneNumber = document.getElementById('lane_number').value;
            const childCount = document.getElementById('child_count').value;

            // Check if the user has children and tries to select an invalid lane
            if (childCount > 0 && ![7, 8].includes(parseInt(laneNumber))) {
                e.preventDefault(); // Prevent form submission
                showWarningPopup(); // Show the warning
            }
        });
    </script>
@endsection
