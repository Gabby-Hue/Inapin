<x-layout>
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">Properti Saya</h1>
            <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Daftar tempat tinggal yang Anda daftarkan pada platform Inapin.</p>
        </div>

        <a href="{{ route('partner.properties.create') }}" class="px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-md shadow-emerald-600/30 flex items-center justify-center gap-2 transition-all">
            <i data-lucide="plus-circle" class="w-4 h-4"></i>
            <span>Tambah Properti</span>
        </a>
    </div>

    @if($properties->count() > 0)
        <div class="space-y-4 mb-10">
            @foreach($properties as $property)
                <div class="bg-white dark:bg-slate-800 rounded-3xl p-6 border border-slate-200/80 dark:border-slate-700 shadow-soft flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div>
                        <div class="flex items-center gap-2 mb-1.5">
                            <x-status-badge :status="$property->status" />
                            <span class="text-xs font-semibold text-slate-400">{{ $property->category }}</span>
                        </div>
                        <h3 class="text-xl font-extrabold text-slate-900 dark:text-white">{{ $property->name }}</h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1 flex items-center gap-1">
                            <i data-lucide="map-pin" class="w-3.5 h-3.5 text-emerald-600"></i>
                            <span>{{ $property->city }}</span>
                            <span>• Rp{{ number_format($property->price_per_night, 0, ',', '.') }}/malam</span>
                        </p>
                    </div>

                    <div class="flex items-center gap-2 border-t md:border-t-0 pt-4 md:pt-0 border-slate-100 dark:border-slate-700">
                        <a href="{{ route('partner.properties.edit', $property) }}" class="px-4 py-2 rounded-xl bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-200 hover:bg-emerald-600 hover:text-white text-xs font-bold transition-all flex items-center gap-1.5">
                            <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                            <span>Edit</span>
                        </a>

                        <form method="post" action="{{ route('partner.properties.destroy', $property) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus properti ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 rounded-xl bg-rose-50 dark:bg-rose-950/60 text-rose-600 dark:text-rose-400 hover:bg-rose-600 hover:text-white text-xs font-bold transition-all flex items-center gap-1.5">
                                <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                <span>Hapus</span>
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white dark:bg-slate-800 rounded-3xl p-12 text-center border border-slate-200 dark:border-slate-700 shadow-soft">
            <i data-lucide="building" class="w-12 h-12 text-slate-400 mx-auto mb-3"></i>
            <h3 class="font-bold text-lg text-slate-800 dark:text-slate-200">Belum Ada Properti</h3>
            <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Anda belum mendaftarkan properti apapun.</p>
            <a href="{{ route('partner.properties.create') }}" class="mt-4 inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-emerald-600 text-white font-bold text-xs shadow-md">
                Tambah Properti Sekarang
            </a>
        </div>
    @endif
</x-layout>
