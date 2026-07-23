<x-layout>
    <div class="mb-8">
        <span class="px-3 py-1 rounded-full bg-emerald-100 dark:bg-emerald-950 text-emerald-700 dark:text-emerald-300 text-xs font-bold uppercase tracking-wider">
            Rekomendasi Terpilih
        </span>
        <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight mt-2">
            Penginapan di {{ $data['city'] }}
        </h1>
        <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">
            Berdasarkan rute perjalanan Anda menuju destinasi {{ $data['city'] }}.
        </p>
    </div>

    @if($properties->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            @foreach($properties as $property)
                <x-property-card :property="$property" />
            @endforeach
        </div>
    @else
        <div class="bg-white dark:bg-slate-800 rounded-3xl p-12 text-center border border-slate-200 dark:border-slate-700 shadow-soft">
            <i data-lucide="building-2" class="w-12 h-12 text-slate-400 mx-auto mb-3"></i>
            <h3 class="font-bold text-lg text-slate-800 dark:text-slate-200">Belum Ada Properti Disetujui</h3>
            <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Belum ada pilihan penginapan terverifikasi untuk destinasi ini saat ini.</p>
            <a href="/properties" class="mt-4 inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-emerald-600 text-white font-bold text-xs shadow-md">
                Lihat Semua Penginapan
            </a>
        </div>
    @endif
</x-layout>
