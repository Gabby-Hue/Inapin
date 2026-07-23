<x-layout>
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">Moderasi Properti</h1>
        <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Setujui atau tolak listing penginapan yang diajukan oleh mitra.</p>
    </div>

    <div class="space-y-4 mb-10">
        @foreach($properties as $property)
            <div class="bg-white dark:bg-slate-800 rounded-3xl p-6 border border-slate-200/80 dark:border-slate-700 shadow-soft flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                    <div class="flex items-center gap-2 mb-1">
                        <x-status-badge :status="$property->status" />
                        <span class="text-xs text-slate-400">Partner: {{ $property->partner->business_name }}</span>
                    </div>
                    <h3 class="text-lg font-extrabold text-slate-900 dark:text-white">{{ $property->name }}</h3>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Kota: {{ $property->city }} • Rp{{ number_format($property->price_per_night, 0, ',', '.') }}/malam</p>
                </div>

                <form method="post" action="{{ route('admin.properties.update', $property) }}" class="flex items-center gap-2 border-t md:border-t-0 pt-3 md:pt-0 border-slate-100 dark:border-slate-700">
                    @csrf
                    @method('PUT')
                    <select name="status" class="px-3 py-2 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-xs font-bold text-slate-800 dark:text-slate-200 outline-none">
                        @foreach(['pending','approved','rejected'] as $status)
                            <option value="{{ $status }}" @selected($property->status === $status)>{{ ucfirst($status) }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-sm transition-all">
                        Simpan
                    </button>
                </form>
            </div>
        @endforeach
    </div>
</x-layout>
