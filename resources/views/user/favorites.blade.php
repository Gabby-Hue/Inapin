<x-layout>
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">Penginapan Favorit</h1>
        <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Daftar villa, resort, dan homestay yang Anda simpan.</p>
    </div>

    @if($favorites->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
            @foreach($favorites as $favorite)
                <div class="relative group">
                    <x-property-card :property="$favorite->property" />
                    
                    <form method="post" action="{{ route('favorites.destroy', $favorite) }}" class="absolute top-3 right-3 z-10">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-9 h-9 rounded-full bg-white/90 dark:bg-slate-900/90 text-rose-500 hover:bg-rose-500 hover:text-white flex items-center justify-center shadow-md transition-all" title="Hapus dari Favorit">
                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white dark:bg-slate-800 rounded-3xl p-12 text-center border border-slate-200 dark:border-slate-700 shadow-soft">
            <i data-lucide="heart-off" class="w-12 h-12 text-slate-400 mx-auto mb-3"></i>
            <h3 class="font-bold text-lg text-slate-800 dark:text-slate-200">Belum Ada Favorit Tersimpan</h3>
            <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Simpan tempat tinggal yang Anda minati saat menjelajah properti.</p>
            <a href="/properties" class="mt-4 inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-emerald-600 text-white font-bold text-xs shadow-md">
                Jelajahi Penginapan
            </a>
        </div>
    @endif
</x-layout>
