<x-layout>
    <nav class="flex items-center gap-2 text-xs font-semibold text-slate-500 dark:text-slate-400 mb-6">
        <a href="/" class="hover:text-emerald-600">Beranda</a>
        <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
        <a href="{{ route('flights.index') }}" class="hover:text-emerald-600">Pesawat</a>
        <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
        <span class="text-slate-900 dark:text-white font-bold">{{ $flight->airline }}</span>
    </nav>

    <!-- Flight Details Hero Banner -->
    <div class="bg-white dark:bg-slate-800 rounded-3xl p-6 sm:p-8 border border-slate-200/80 dark:border-slate-700 shadow-soft mb-10">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 pb-6 border-b border-slate-100 dark:border-slate-700">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-2xl bg-emerald-600 text-white flex items-center justify-center font-extrabold text-xl shadow-md">
                    <i data-lucide="plane" class="w-7 h-7"></i>
                </div>
                <div>
                    <span class="text-xs font-bold text-emerald-600 dark:text-emerald-400 uppercase tracking-wider">Maskapai Penerbangan</span>
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white">{{ $flight->airline }}</h1>
                </div>
            </div>

            <div class="text-left md:text-right">
                <span class="text-xs text-slate-400">Total Tarif Per Penumpang</span>
                <div class="text-3xl font-extrabold text-emerald-600 dark:text-emerald-400">
                    Rp{{ number_format($flight->price, 0, ',', '.') }}
                </div>
            </div>
        </div>

        <!-- Route Breakdown -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-6">
            <div class="flex items-start gap-4 p-4 rounded-2xl bg-slate-50 dark:bg-slate-900/50">
                <div class="w-10 h-10 rounded-xl bg-slate-200 dark:bg-slate-800 text-slate-700 dark:text-slate-300 flex items-center justify-center shrink-0">
                    <i data-lucide="plane-takeoff" class="w-5 h-5"></i>
                </div>
                <div>
                    <span class="text-xs font-semibold text-slate-400 uppercase">Keberangkatan</span>
                    <h4 class="font-extrabold text-base text-slate-900 dark:text-white">{{ $flight->originAirport->city }} ({{ $flight->originAirport->code }})</h4>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">{{ $flight->originAirport->name }}</p>
                    <span class="inline-block mt-2 px-2.5 py-1 rounded-md bg-white dark:bg-slate-800 text-xs font-bold text-slate-700 dark:text-slate-200 border border-slate-200 dark:border-slate-700">
                        {{ $flight->departure_time }}
                    </span>
                </div>
            </div>

            <div class="flex items-start gap-4 p-4 rounded-2xl bg-slate-50 dark:bg-slate-900/50">
                <div class="w-10 h-10 rounded-xl bg-slate-200 dark:bg-slate-800 text-slate-700 dark:text-slate-300 flex items-center justify-center shrink-0">
                    <i data-lucide="plane-landing" class="w-5 h-5"></i>
                </div>
                <div>
                    <span class="text-xs font-semibold text-slate-400 uppercase">Kedatangan</span>
                    <h4 class="font-extrabold text-base text-slate-900 dark:text-white">{{ $flight->destinationAirport->city }} ({{ $flight->destinationAirport->code }})</h4>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">{{ $flight->destinationAirport->name }}</p>
                    <span class="inline-block mt-2 px-2.5 py-1 rounded-md bg-white dark:bg-slate-800 text-xs font-bold text-slate-700 dark:text-slate-200 border border-slate-200 dark:border-slate-700">
                        {{ $flight->arrival_time }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Recommended Stays at Destination -->
    <div class="mb-10">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Rekomendasi Penginapan di {{ $flight->destinationAirport->city }}</h2>
                <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Tempat tinggal nyaman setelah Anda mendarat di {{ $flight->destinationAirport->city }}.</p>
            </div>
            <a href="/properties?city={{ urlencode($flight->destinationAirport->city) }}" class="text-xs font-bold text-emerald-600 dark:text-emerald-400 hover:underline">
                Lihat Semua
            </a>
        </div>

        @if($properties->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($properties as $property)
                    <x-property-card :property="$property" />
                @endforeach
            </div>
        @else
            <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 text-center border border-slate-200 dark:border-slate-700 text-slate-500 text-sm">
                Belum ada rekomendasi penginapan di destinasi ini.
            </div>
        @endif
    </div>
</x-layout>
