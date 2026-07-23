<x-layout>
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">Manajemen Flight & Bandara</h1>
        <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Tambah rute penerbangan baru dan data master bandara.</p>
    </div>

    <!-- Add Airport Form Card -->
    <div class="bg-white dark:bg-slate-800 rounded-3xl p-6 mb-8 border border-slate-200/80 dark:border-slate-700 shadow-soft">
        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-4 flex items-center gap-2">
            <i data-lucide="plus-circle" class="w-5 h-5 text-emerald-600"></i>
            <span>Tambah Master Bandara</span>
        </h3>
        
        <form method="post" action="{{ route('admin.airports.store') }}" class="grid grid-cols-1 sm:grid-cols-4 gap-3">
            @csrf
            <input name="name" required placeholder="Nama Bandara (misal: Soekarno-Hatta)" class="px-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-xs font-medium outline-none">
            <input name="city" required placeholder="Kota (misal: Jakarta)" class="px-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-xs font-medium outline-none">
            <input name="code" required placeholder="Kode IATA (misal: CGK)" class="px-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-xs font-medium outline-none">
            <button type="submit" class="py-2.5 px-4 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-md transition-all">
                Tambah Bandara
            </button>
        </form>
    </div>

    <!-- Add Flight Schedule Form Card -->
    <div class="bg-white dark:bg-slate-800 rounded-3xl p-6 mb-8 border border-slate-200/80 dark:border-slate-700 shadow-soft">
        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-4 flex items-center gap-2">
            <i data-lucide="plane" class="w-5 h-5 text-emerald-600"></i>
            <span>Tambah Jadwal Penerbangan</span>
        </h3>

        <form method="post" action="{{ route('admin.flights.store') }}" class="grid grid-cols-1 sm:grid-cols-3 gap-3">
            @csrf
            <input name="airline" required placeholder="Nama Maskapai (misal: Inapin Air)" class="px-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-xs font-medium outline-none">
            
            <select name="origin_airport_id" required class="px-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-xs font-medium outline-none">
                <option value="">Bandara Asal</option>
                @foreach($airports as $airport)
                    <option value="{{ $airport->id }}">{{ $airport->city }} ({{ $airport->code }})</option>
                @endforeach
            </select>

            <select name="destination_airport_id" required class="px-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-xs font-medium outline-none">
                <option value="">Bandara Tujuan</option>
                @foreach($airports as $airport)
                    <option value="{{ $airport->id }}">{{ $airport->city }} ({{ $airport->code }})</option>
                @endforeach
            </select>

            <input type="datetime-local" name="departure_time" required class="px-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-xs font-medium outline-none">
            <input type="datetime-local" name="arrival_time" required class="px-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-xs font-medium outline-none">
            <input type="number" name="price" required placeholder="Harga Tiket (Rp)" class="px-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-xs font-medium outline-none">

            <div class="sm:col-span-3">
                <button type="submit" class="w-full py-2.5 px-4 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-md transition-all">
                    Tambah Jadwal Flight
                </button>
            </div>
        </form>
    </div>

    <!-- Flight List -->
    <div class="space-y-3 mb-10">
        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Daftar Flight Aktif</h3>
        @foreach($flights as $flight)
            <div class="bg-white dark:bg-slate-800 rounded-2xl p-4 border border-slate-200/80 dark:border-slate-700 shadow-soft flex items-center justify-between">
                <div>
                    <span class="font-extrabold text-sm text-slate-900 dark:text-white">{{ $flight->airline }}</span>
                    <p class="text-xs text-slate-500 mt-0.5">
                        {{ $flight->originAirport->city }} ({{ $flight->originAirport->code }}) &rarr; {{ $flight->destinationAirport->city }} ({{ $flight->destinationAirport->code }})
                    </p>
                </div>
                <div class="text-right">
                    <span class="font-bold text-emerald-600 dark:text-emerald-400 text-sm">Rp{{ number_format($flight->price, 0, ',', '.') }}</span>
                </div>
            </div>
        @endforeach
    </div>
</x-layout>
