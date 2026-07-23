<x-layout>
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">Manajemen Kapal & Pelabuhan</h1>
        <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Tambah rute kapal penyeberangan dan data master pelabuhan laut.</p>
    </div>

    <!-- Add Port Form Card -->
    <div class="bg-white dark:bg-slate-800 rounded-3xl p-6 mb-8 border border-slate-200/80 dark:border-slate-700 shadow-soft">
        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-4 flex items-center gap-2">
            <i data-lucide="plus-circle" class="w-5 h-5 text-teal-600"></i>
            <span>Tambah Master Pelabuhan</span>
        </h3>
        
        <form method="post" action="{{ route('admin.ports.store') }}" class="grid grid-cols-1 sm:grid-cols-3 gap-3">
            @csrf
            <input name="name" required placeholder="Nama Pelabuhan (misal: Benoa)" class="px-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-xs font-medium outline-none">
            <input name="city" required placeholder="Kota (misal: Bali)" class="px-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-xs font-medium outline-none">
            <button type="submit" class="py-2.5 px-4 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-md transition-all">
                Tambah Pelabuhan
            </button>
        </form>
    </div>

    <!-- Add Ferry Schedule Form Card -->
    <div class="bg-white dark:bg-slate-800 rounded-3xl p-6 mb-8 border border-slate-200/80 dark:border-slate-700 shadow-soft">
        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-4 flex items-center gap-2">
            <i data-lucide="ship" class="w-5 h-5 text-teal-600"></i>
            <span>Tambah Jadwal Kapal Laut</span>
        </h3>

        <form method="post" action="{{ route('admin.ferries.store') }}" class="grid grid-cols-1 sm:grid-cols-3 gap-3">
            @csrf
            <input name="operator" required placeholder="Nama Operator (misal: Inapin Ferry)" class="px-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-xs font-medium outline-none">
            
            <select name="origin_port_id" required class="px-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-xs font-medium outline-none">
                <option value="">Pelabuhan Asal</option>
                @foreach($ports as $port)
                    <option value="{{ $port->id }}">{{ $port->city }} - {{ $port->name }}</option>
                @endforeach
            </select>

            <select name="destination_port_id" required class="px-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-xs font-medium outline-none">
                <option value="">Pelabuhan Tujuan</option>
                @foreach($ports as $port)
                    <option value="{{ $port->id }}">{{ $port->city }} - {{ $port->name }}</option>
                @endforeach
            </select>

            <input type="datetime-local" name="departure_time" required class="px-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-xs font-medium outline-none">
            <input type="datetime-local" name="arrival_time" required class="px-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-xs font-medium outline-none">
            <input type="number" name="price" required placeholder="Harga Tiket (Rp)" class="px-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-xs font-medium outline-none">

            <div class="sm:col-span-3">
                <button type="submit" class="w-full py-2.5 px-4 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-md transition-all">
                    Tambah Jadwal Ferry
                </button>
            </div>
        </form>
    </div>

    <!-- Ferry List -->
    <div class="space-y-3 mb-10">
        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Daftar Kapal Aktif</h3>
        @foreach($ferries as $ferry)
            <div class="bg-white dark:bg-slate-800 rounded-2xl p-4 border border-slate-200/80 dark:border-slate-700 shadow-soft flex items-center justify-between">
                <div>
                    <span class="font-extrabold text-sm text-slate-900 dark:text-white">{{ $ferry->operator }}</span>
                    <p class="text-xs text-slate-500 mt-0.5">
                        {{ $ferry->originPort->city }} ({{ $ferry->originPort->name }}) &rarr; {{ $ferry->destinationPort->city }} ({{ $ferry->destinationPort->name }})
                    </p>
                </div>
                <div class="text-right">
                    <span class="font-bold text-emerald-600 dark:text-emerald-400 text-sm">Rp{{ number_format($ferry->price, 0, ',', '.') }}</span>
                </div>
            </div>
        @endforeach
    </div>
</x-layout>
