<x-layout>
    <!-- Header Banner -->
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">Cari Penginapan</h1>
        <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Temukan resort, villa, homestay, dan glamping terbaik di seluruh Indonesia.</p>
    </div>

    <!-- Filter & Search Bar -->
    <div class="bg-white dark:bg-slate-800 rounded-2xl p-4 sm:p-6 mb-8 border border-slate-200/80 dark:border-slate-700 shadow-soft">
        <form method="GET" action="{{ route('properties.index') }}" class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-7 gap-3">
            <div class="lg:col-span-3">
                <label class="block text-[11px] font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1">Kota / Lokasi</label>
                <div class="relative">
                    <i data-lucide="map-pin" class="w-4 h-4 absolute left-3.5 top-3 text-slate-400"></i>
                    <input type="text" name="city" value="{{ request('city') }}" placeholder="Cari nama kota (misal: Bali, Yogyakarta)" 
                           class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-sm font-medium focus:ring-2 focus:ring-emerald-500 outline-none transition-all">
                </div>
            </div>

            <div class="lg:col-span-2">
                <label class="block text-[11px] font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1">Kategori</label>
                <div class="relative">
                    <i data-lucide="filter" class="w-4 h-4 absolute left-3.5 top-3 text-slate-400"></i>
                    <select name="category" class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-sm font-medium focus:ring-2 focus:ring-emerald-500 outline-none transition-all appearance-none">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category }}" @selected(request('category') === $category)>{{ $category }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="lg:col-span-2 flex items-end gap-2">
                <button type="submit" class="flex-1 py-2.5 px-4 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm shadow-md shadow-emerald-600/30 flex items-center justify-center gap-2 transition-all">
                    <i data-lucide="search" class="w-4 h-4"></i>
                    <span>Cari</span>
                </button>
                @if(request('city') || request('category'))
                    <a href="{{ route('properties.index') }}" class="py-2.5 px-3 rounded-xl bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-600 font-bold text-xs flex items-center justify-center transition-all" title="Reset Filter">
                        <i data-lucide="rotate-ccw" class="w-4 h-4"></i>
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Results Header -->
    <div class="flex items-center justify-between mb-6">
        <p class="text-sm font-semibold text-slate-600 dark:text-slate-300">
            Menampilkan <span class="text-emerald-600 dark:text-emerald-400 font-bold">{{ $properties->total() }}</span> penginapan
            @if(request('city')) untuk kota "<span class="font-bold">{{ request('city') }}</span>"@endif
            @if(request('category')) kategori "<span class="font-bold">{{ request('category') }}</span>"@endif
        </p>
    </div>

    <!-- Properties Grid -->
    @if($properties->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            @foreach($properties as $property)
                <x-property-card :property="$property" />
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8 flex justify-center">
            {{ $properties->links() }}
        </div>
    @else
        <!-- Empty State -->
        <div class="bg-white dark:bg-slate-800 rounded-3xl p-12 text-center border border-slate-200 dark:border-slate-700 shadow-soft my-8">
            <div class="w-16 h-16 rounded-2xl bg-emerald-50 dark:bg-emerald-950/50 text-emerald-600 dark:text-emerald-400 flex items-center justify-center mx-auto mb-4">
                <i data-lucide="search-x" class="w-8 h-8"></i>
            </div>
            <h3 class="text-xl font-bold text-slate-900 dark:text-white">Tidak Ada Penginapan Ditemukan</h3>
            <p class="text-slate-500 dark:text-slate-400 text-sm max-w-md mx-auto mt-2">
                Kami tidak dapat menemukan penginapan yang sesuai dengan kriteria pencarian Anda. Coba ubah nama kota atau kategori.
            </p>
            <a href="{{ route('properties.index') }}" class="mt-6 inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-emerald-600 text-white font-bold text-sm hover:bg-emerald-700 shadow-md shadow-emerald-600/20 transition-all">
                <i data-lucide="refresh-cw" class="w-4 h-4"></i>
                <span>Tampilkan Semua Penginapan</span>
            </a>
        </div>
    @endif
</x-layout>
