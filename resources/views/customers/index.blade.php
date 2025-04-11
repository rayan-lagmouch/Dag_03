@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-6">
        <div class="bg-white p-6 rounded-xl shadow-md">
            <h1 class="text-2xl font-bold mb-4">Overzicht Klanten</h1>

            {{-- Date Filter Form --}}
            <form method="GET" action="{{ route('customers.index') }}" class="mb-6 flex items-center gap-4">
                <label for="date" class="text-sm font-medium text-gray-700">Selecteer datum (Registratiedatum tot):</label>
                <input type="text" id="date" name="date" value="{{ old('date', request('date')) }}" class="border rounded p-2 text-sm w-40" placeholder="YYYY-MM-DD" />
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Filter
                </button>
            </form>

            {{-- Customer Table --}}
            <div class="overflow-x-auto">
                @if($customers->isEmpty())
                    <div class="text-center py-6">Er is geen informatie beschikbaar voor deze geselecteerde datum.</div>
                @else
                    <table class="min-w-full table-auto border border-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left">Naam</th>
                                <th class="px-4 py-2 text-left">Mobiel</th>
                                <th class="px-4 py-2 text-left">Email</th>
                                <th class="px-4 py-2 text-left">Volwassen</th>
                                <th class="px-4 py-2 text-left">Acties</th>  <!-- Added Actions Column -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($customers as $customer)
                                <tr class="border-t">
                                    <td class="px-4 py-2">{{ $customer->first_name . ' ' . $customer->last_name }}</td>  {{-- Full name --}}
                                    <td class="px-4 py-2">{{ optional($customer->contact)->mobile ?? '—' }}</td>  {{-- Mobile --}}
                                    <td class="px-4 py-2">{{ optional($customer->contact)->email ?? '—' }}</td>  {{-- Email --}}
                                    <td class="px-4 py-2">{{ $customer->is_adult ? 'Ja' : 'Nee' }}</td>  {{-- Adult status --}}
                                    <td class="px-4 py-2">
                                        <a href="{{ route('customers.edit', $customer->id) }}" class="text-blue-600 hover:text-blue-800">Wijzigen</a>  {{-- Edit Link --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection
