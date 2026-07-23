<x-layout>
    <!-- Admin Hero Banner -->
    <div class="rounded-3xl bg-gradient-to-r from-slate-900 via-emerald-950 to-slate-950 text-white p-8 sm:p-10 mb-8 shadow-soft-lg">
        <span class="text-xs font-bold text-amber-400 uppercase tracking-widest">Panel Administrator</span>
        <h1 class="text-3xl font-extrabold text-white mt-1">Dashboard Moderasi Admin</h1>
        <p class="text-slate-300 text-sm mt-1">Kelola data pengguna, verifikasi partner, setujui properti, serta atur penerbangan & kapal.</p>
    </div>

    <!-- Analytics Counter Cards -->
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4 mb-8">
        @foreach($counts as $label => $count)
            <div class="bg-white dark:bg-slate-800 rounded-2xl p-4 border border-slate-200/80 dark:border-slate-700 shadow-soft">
                <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">{{ ucfirst($label) }}</span>
                <div class="text-2xl font-extrabold text-emerald-600 dark:text-emerald-400 mt-1">
                    {{ number_format($count) }}
                </div>
            </div>
        @endforeach
    </div>

    <!-- Admin Navigation Quick Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
        
        <a href="/admin/users" class="group bg-white dark:bg-slate-800 rounded-3xl p-6 border border-slate-200/80 dark:border-slate-700 shadow-soft hover:shadow-soft-lg transition-all duration-300">
            <div class="w-12 h-12 rounded-2xl bg-blue-50 dark:bg-blue-950/60 text-blue-600 dark:text-blue-400 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                <i data-lucide="users" class="w-6 h-6"></i>
            </div>
            <h3 class="font-extrabold text-lg text-slate-900 dark:text-white group-hover:text-blue-600 transition-colors">
                Kelola Users
            </h3>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Daftar wisatawan, partner, dan administrator terdaftar.</p>
        </a>

        <a href="/admin/partners" class="group bg-white dark:bg-slate-800 rounded-3xl p-6 border border-slate-200/80 dark:border-slate-700 shadow-soft hover:shadow-soft-lg transition-all duration-300">
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                <i data-lucide="shield-check" class="w-6 h-6"></i>
            </div>
            <h3 class="font-extrabold text-lg text-slate-900 dark:text-white group-hover:text-emerald-600 transition-colors">
                Verifikasi Partner
            </h3>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Setujui atau tolak pendaftaran mitra penginapan baru.</p>
        </a>

        <a href="/admin/properties" class="group bg-white dark:bg-slate-800 rounded-3xl p-6 border border-slate-200/80 dark:border-slate-700 shadow-soft hover:shadow-soft-lg transition-all duration-300">
            <div class="w-12 h-12 rounded-2xl bg-teal-50 dark:bg-teal-950/60 text-teal-600 dark:text-teal-400 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                <i data-lucide="building" class="w-6 h-6"></i>
            </div>
            <h3 class="font-extrabold text-lg text-slate-900 dark:text-white group-hover:text-teal-600 transition-colors">
                Moderasi Properti
            </h3>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Tinjau kelayakan listing villa, resort, dan homestay.</p>
        </a>

        <a href="/admin/flights" class="group bg-white dark:bg-slate-800 rounded-3xl p-6 border border-slate-200/80 dark:border-slate-700 shadow-soft hover:shadow-soft-lg transition-all duration-300">
            <div class="w-12 h-12 rounded-2xl bg-amber-50 dark:bg-amber-950/60 text-amber-600 dark:text-amber-400 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                <i data-lucide="plane" class="w-6 h-6"></i>
            </div>
            <h3 class="font-extrabold text-lg text-slate-900 dark:text-white group-hover:text-amber-600 transition-colors">
                Master Flights & Bandara
            </h3>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Tambah data penerbangan dan informasi bandara Indonesia.</p>
        </a>

        <a href="/admin/ferries" class="group bg-white dark:bg-slate-800 rounded-3xl p-6 border border-slate-200/80 dark:border-slate-700 shadow-soft hover:shadow-soft-lg transition-all duration-300">
            <div class="w-12 h-12 rounded-2xl bg-indigo-50 dark:bg-indigo-950/60 text-indigo-600 dark:text-indigo-400 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                <i data-lucide="ship" class="w-6 h-6"></i>
            </div>
            <h3 class="font-extrabold text-lg text-slate-900 dark:text-white group-hover:text-indigo-600 transition-colors">
                Master Ferries & Pelabuhan
            </h3>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Tambah jadwal rute kapal penyeberangan antar-pulau.</p>
        </a>

        <a href="/admin/reviews" class="group bg-white dark:bg-slate-800 rounded-3xl p-6 border border-slate-200/80 dark:border-slate-700 shadow-soft hover:shadow-soft-lg transition-all duration-300">
            <div class="w-12 h-12 rounded-2xl bg-rose-50 dark:bg-rose-950/60 text-rose-600 dark:text-rose-400 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                <i data-lucide="star" class="w-6 h-6"></i>
            </div>
            <h3 class="font-extrabold text-lg text-slate-900 dark:text-white group-hover:text-rose-600 transition-colors">
                Moderasi Reviews
            </h3>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Pantau dan hapus ulasan tamu yang tidak pantas.</p>
        </a>

    </div>
</x-layout>
