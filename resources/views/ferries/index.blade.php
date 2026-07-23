<x-layout>
    <!-- Header Banner -->
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">Cari Jadwal Kapal Laut</h1>
        <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Pesan tiket kapal penyeberangan antar-pelabuhan Nusantara.</p>
    </div>

    <!-- Ferry Search Form -->
    <div class="bg-white dark:bg-slate-800 rounded-2xl p-4 sm:p-6 mb-8 border border-slate-200/80 dark:border-slate-700 shadow-soft">
        <form action="{{ route('ferries.search') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-3 gap-3">
            <div>
                <label class="block text-[11px] font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1">Pelabuhan / Kota Asal</label>
                <div class="relative">
                    <i data-lucide="anchor" class="w-4 h-4 absolute left-3.5 top-3 text-slate-400"></i>
                    <input name="origin" value="{{ request('origin') }}" placeholder="Contoh: Tanjung Priok" 
                           class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-sm font-medium focus:ring-2 focus:ring-emerald-500 outline-none transition-all">
                </div>
            </div>

            <div>
                <label class="block text-[11px] font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1">Pelabuhan / Kota Tujuan</label>
                <div class="relative">
                    <i data-lucide="navigation" class="w-4 h-4 absolute left-3.5 top-3 text-slate-400"></i>
                    <input name="destination" value="{{ request('destination') }}" placeholder="Contoh: Benoa" 
                           class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-sm font-medium focus:ring-2 focus:ring-emerald-500 outline-none transition-all">
                </div>
            </div>

            <div class="flex items-end gap-2">
                <button type="submit" class="flex-1 py-2.5 px-4 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm shadow-md shadow-emerald-600/30 flex items-center justify-center gap-2 transition-all">
                    <i data-lucide="search" class="w-4 h-4"></i>
                    <span>Cari Jadwal</span>
                </button>
                @if(request('origin') || request('destination'))
                    <a href="{{ route('ferries.index') }}" class="py-2.5 px-3 rounded-xl bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 font-bold text-xs flex items-center justify-center transition-all" title="Reset">
                        <i data-lucide="rotate-ccw" class="w-4 h-4"></i>
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Ferry List -->
    @if($ferries->count() > 0)
        <div class="space-y-4 mb-8">
            @foreach($ferries as $ferry)
                <a href="{{ route('ferries.show', $ferry) }}" class="group block bg-white dark:bg-slate-800 rounded-2xl p-5 border border-slate-200/80 dark:border-slate-700 shadow-soft hover:shadow-soft-lg hover:border-emerald-500/50 transition-all duration-300">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                        
                        <!-- Operator Info -->
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-teal-50 dark:bg-teal-950/60 text-teal-600 dark:text-teal-400 flex items-center justify-center font-black text-lg shrink-0 group-hover:scale-105 transition-transform">
                                <i data-lucide="ship" class="w-6 h-6"></i>
                            </div>
                            <div>
                                <h3 class="font-extrabold text-slate-900 dark:text-white text-base group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">
                                    {{ $ferry->operator }}
                                </h3>
                                <span class="text-xs text-slate-500 dark:text-slate-400 font-medium">Kapal Penyeberangan Laut</span>
                            </div>
                        </div>

                        <!-- Route Line & Port Badges -->
                        <div class="flex items-center gap-4 text-center">
                            <div>
                                <div class="text-base font-extrabold text-slate-900 dark:text-white">{{ $ferry->originPort->city }}</div>
                                <span class="text-xs font-bold text-slate-400">{{ $ferry->originPort->name }}</span>
                            </div>

                            <div class="flex flex-col items-center px-4">
                                <span class="text-[10px] font-semibold text-slate-400 mb-1">Rute Laut</span>
                                <div class="w-24 sm:w-36 h-0.5 bg-slate-200 dark:bg-slate-700 relative flex items-center justify-center">
                                    <i data-lucide="ship" class="w-4 h-4 text-teal-600 dark:text-teal-400 bg-white dark:bg-slate-800 px-0.5"></i>
                                </div>
                            </div>

                            <div>
                                <div class="text-base font-extrabold text-slate-900 dark:text-white">{{ $ferry->destinationPort->city }}</div>
                                <span class="text-xs font-bold text-slate-400">{{ $ferry->destinationPort->name }}</span>
                            </div>
                        </div>

                        <!-- Price & Action -->
                        <div class="flex items-center justify-between md:justify-end gap-4 border-t md:border-t-0 pt-3 md:pt-0 border-slate-100 dark:border-slate-700">
                            <div class="text-left md:text-right">
                                <span class="text-[11px] text-slate-400">Harga Per Penumpang</span>
                                <div class="text-xl font-extrabold text-emerald-600 dark:text-emerald-400">
                                    Rp{{ number_format($ferry->price, 0, ',', '.') }}
                                </div>
                            </div>
                            <div class="w-9 h-9 rounded-xl bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 group-hover:bg-emerald-600 group-hover:text-white flex items-center justify-center transition-colors">
                                <i data-lucide="chevron-right" class="w-5 h-5"></i>
                            </div>
                        </div>

                    </div>
                </a>
            @endforeach
        </div>

        <div class="mt-8 flex justify-center">
            {{ $ferries->links() }}
        </div>
    @else
        <div class="bg-white dark:bg-slate-800 rounded-3xl p-12 text-center border border-slate-200 dark:border-slate-700 shadow-soft">
            <i data-lucide="anchor" class="w-12 h-12 text-slate-400 mx-auto mb-3"></i>
            <h3 class="font-bold text-lg text-slate-800 dark:text-slate-200">Tidak Ada Jadwal Kapal Ditemukan</h3>
            <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Coba sesuaikan kata kunci pencarian pelabuhan Anda.</p>
        </div>
    @endif
</x-layout>
