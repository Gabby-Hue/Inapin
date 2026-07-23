<x-layout>
    <!-- Partner Dashboard Hero -->
    <div class="rounded-3xl bg-gradient-to-r from-emerald-900 via-teal-900 to-slate-900 text-white p-8 sm:p-10 mb-8 shadow-soft-lg">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <span class="text-xs font-bold text-emerald-300 uppercase tracking-widest">Portal Mitra Penginapan</span>
                <h1 class="text-3xl font-extrabold text-white mt-1">Dashboard Partner</h1>
                <p class="text-emerald-100/80 text-sm mt-1">Kelola listing properti dan pantau booking tamu yang masuk.</p>
            </div>

            <div class="flex items-center gap-3">
                <span class="text-xs text-slate-300">Status Verifikasi:</span>
                <x-status-badge :status="$partner?->verification_status ?? 'pending'" />
            </div>
        </div>
    </div>

    <!-- Controls Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-10">
        
        <a href="{{ route('partner.properties.index') }}" class="group bg-white dark:bg-slate-800 rounded-3xl p-6 border border-slate-200/80 dark:border-slate-700 shadow-soft hover:shadow-soft-lg transition-all duration-300">
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                <i data-lucide="building" class="w-6 h-6"></i>
            </div>
            <h3 class="font-extrabold text-lg text-slate-900 dark:text-white group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">
                Kelola Properti Saya
            </h3>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Tambah properti baru, perbarui informasi kamar, harga, dan foto lokasi.</p>
        </a>

        <a href="{{ route('partner.bookings.index') }}" class="group bg-white dark:bg-slate-800 rounded-3xl p-6 border border-slate-200/80 dark:border-slate-700 shadow-soft hover:shadow-soft-lg transition-all duration-300">
            <div class="w-12 h-12 rounded-2xl bg-amber-50 dark:bg-amber-950/60 text-amber-600 dark:text-amber-400 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                <i data-lucide="inbox" class="w-6 h-6"></i>
            </div>
            <h3 class="font-extrabold text-lg text-slate-900 dark:text-white group-hover:text-amber-600 dark:group-hover:text-amber-400 transition-colors">
                Booking Masuk
            </h3>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Konfirmasi reservasi tamu, ubah status pesanan, dan cek detail check-in.</p>
        </a>

    </div>
</x-layout>
