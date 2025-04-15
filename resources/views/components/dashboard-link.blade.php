@props(['route', 'label'])

<a href="{{ route($route) }}"
   class="block p-5 bg-blue-50 hover:bg-blue-100 text-blue-800 rounded-2xl border border-blue-200 shadow-sm transition-all">
    <h3 class="text-lg font-semibold">{{ $label }}</h3>
</a>
