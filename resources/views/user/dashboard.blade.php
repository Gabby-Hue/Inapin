<x-layout>
    <!-- User Welcome Header Banner -->
    <div class="rounded-3xl bg-gradient-to-r from-slate-900 via-emerald-950 to-slate-900 text-white p-8 sm:p-10 mb-8 shadow-soft-lg relative overflow-hidden">
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 rounded-2xl bg-emerald-500 text-white font-black text-2xl flex items-center justify-center shadow-lg shadow-emerald-500/30">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div>
                    <span class="text-xs font-bold text-amber-400 uppercase tracking-widest">Portal Wisatawan</span>
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-white">Selamat Datang, {{ Auth::user()->name }}</h1>
                    <p class="text-slate-300 text-sm mt-1">Kelola riwayat pesanan, penginapan favorit, dan pengaturan akun Anda.</p>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <a href="/bookings" class="px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm shadow-md transition-all flex items-center gap-2">
                    <i data-lucide="receipt" class="w-4 h-4"></i>
                    <span>Riwayat Booking</span>
                </a>
                <a href="/favorites" class="px-5 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 text-white font-bold text-sm backdrop-blur-md transition-all flex items-center gap-2">
                    <i data-lucide="heart" class="w-4 h-4 text-rose-400"></i>
                    <span>Favorit</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Quick Shortcuts Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-10">
        
        <a href="/bookings" class="group bg-white dark:bg-slate-800 rounded-3xl p-6 border border-slate-200/80 dark:border-slate-700 shadow-soft hover:shadow-soft-lg transition-all duration-300">
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                <i data-lucide="calendar" class="w-6 h-6"></i>
            </div>
            <h3 class="font-extrabold text-lg text-slate-900 dark:text-white group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">
                Riwayat Pemesanan
            </h3>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Lihat status booking, e-tiket, dan beri ulasan penginapan.</p>
        </a>

        <a href="/favorites" class="group bg-white dark:bg-slate-800 rounded-3xl p-6 border border-slate-200/80 dark:border-slate-700 shadow-soft hover:shadow-soft-lg transition-all duration-300">
            <div class="w-12 h-12 rounded-2xl bg-rose-50 dark:bg-rose-950/60 text-rose-600 dark:text-rose-400 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                <i data-lucide="heart" class="w-6 h-6"></i>
            </div>
            <h3 class="font-extrabold text-lg text-slate-900 dark:text-white group-hover:text-rose-600 dark:group-hover:text-rose-400 transition-colors">
                Penginapan Impian
            </h3>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Daftar villa dan resort simpanan untuk liburan berikutnya.</p>
        </a>

        <a href="/properties" class="group bg-white dark:bg-slate-800 rounded-3xl p-6 border border-slate-200/80 dark:border-slate-700 shadow-soft hover:shadow-soft-lg transition-all duration-300">
            <div class="w-12 h-12 rounded-2xl bg-amber-50 dark:bg-amber-950/60 text-amber-600 dark:text-amber-400 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                <i data-lucide="search" class="w-6 h-6"></i>
            </div>
            <h3 class="font-extrabold text-lg text-slate-900 dark:text-white group-hover:text-amber-600 dark:group-hover:text-amber-400 transition-colors">
                Cari Tempat Menginap
            </h3>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Jelajahi ketersediaan kamar di seluruh destinasi Indonesia.</p>
        </a>

    </div>
</x-layout>
