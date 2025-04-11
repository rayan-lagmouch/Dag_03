<form action="{{ route('reservations.update.lane', $reservation->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-6">
        <label for="lane_number" class="block text-lg font-medium text-gray-700">Select Lane Number</label>
        <select id="lane_number" name="lane_number" class="mt-2 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
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

    <div class="flex justify-center mt-6">
        <button type="submit" class="bg-blue-500 text-white px-8 py-3 rounded-md shadow-md hover:bg-blue-600 transition duration-200">Update Lane</button>
    </div>
</form>
