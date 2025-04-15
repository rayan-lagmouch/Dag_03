<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.3/dist/tailwind.min.css" rel="stylesheet">

<form action="{{ route('reservations.update.lane', $reservation->id) }}" method="POST" class="max-w-lg mx-auto p-6 bg-white rounded-lg shadow-lg">
    @csrf

    {{-- Back Button --}}
    <div class="mb-4">
        <a href="/reservations" class="text-blue-500 hover:text-blue-700 font-medium text-lg">&larr; Back to Reservations</a>
    </div>

    {{-- Lane Number Selection --}}
    <div class="mb-6">
        <label for="lane_number" class="block text-xl font-semibold text-gray-700 mb-2">Select a Lane</label>
        <select id="lane_number" name="lane_number" class="mt-2 block w-full p-4 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-gray-800">
            @for ($i = 1; $i <= 8; $i++)
                <option value="{{ $i }}" {{ $reservation->lane_id == $i ? 'selected' : '' }}>
                    Lane {{ $i }}
                </option>
            @endfor
        </select>
        @error('lane_number')
            <p class="text-red-500 mt-2 text-sm">{{ $message }}</p>
        @enderror
    </div>

    {{-- Submit Button --}}
    <div class="flex justify-center mt-6">
        <button type="submit" class="bg-blue-600 text-white px-8 py-3 rounded-md shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200">
            Update Lane
        </button>
    </div>
</form>
