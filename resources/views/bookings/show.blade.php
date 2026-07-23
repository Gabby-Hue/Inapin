<x-layout>
    <nav class="flex items-center gap-2 text-xs font-semibold text-slate-500 dark:text-slate-400 mb-6">
        <a href="/" class="hover:text-emerald-600">Beranda</a>
        <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
        <a href="/bookings" class="hover:text-emerald-600">Booking Saya</a>
        <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
        <span class="text-slate-900 dark:text-white font-bold">Kode #{{ $booking->id }}</span>
    </nav>

    <!-- Main Booking Summary Card -->
    <div class="max-w-3xl mx-auto bg-white dark:bg-slate-800 rounded-3xl p-6 sm:p-8 border border-slate-200/90 dark:border-slate-700 shadow-soft-lg">
        
        <!-- Header status -->
        <div class="flex items-center justify-between pb-6 border-b border-slate-100 dark:border-slate-700">
            <div>
                <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Detail E-Voucher</span>
                <h1 class="text-2xl font-extrabold text-slate-900 dark:text-white mt-0.5">Booking #{{ $booking->id }}</h1>
            </div>
            <x-status-badge :status="$booking->status" />
        </div>

        <!-- Property Title & Link -->
        <div class="py-6 border-b border-slate-100 dark:border-slate-700">
            <h2 class="text-xl font-bold text-slate-900 dark:text-white">
                {{ $booking->property->name }}
            </h2>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1 flex items-center gap-1">
                <i data-lucide="map-pin" class="w-3.5 h-3.5 text-emerald-600"></i>
                <span>{{ $booking->property->address }}, {{ $booking->property->city }}</span>
            </p>
        </div>

        <!-- Checkin & Checkout Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 py-6 border-b border-slate-100 dark:border-slate-700">
            <div class="p-4 rounded-2xl bg-slate-50 dark:bg-slate-900/60 border border-slate-100 dark:border-slate-700">
                <span class="text-[11px] font-semibold text-slate-400 uppercase">Tanggal Check-In</span>
                <h4 class="text-lg font-extrabold text-slate-900 dark:text-white mt-1">
                    {{ $booking->check_in->format('d M Y') }}
                </h4>
                <p class="text-xs text-slate-500 mt-0.5">Mulai 14:00 WIB</p>
            </div>

            <div class="p-4 rounded-2xl bg-slate-50 dark:bg-slate-900/60 border border-slate-100 dark:border-slate-700">
                <span class="text-[11px] font-semibold text-slate-400 uppercase">Tanggal Check-Out</span>
                <h4 class="text-lg font-extrabold text-slate-900 dark:text-white mt-1">
                    {{ $booking->check_out->format('d M Y') }}
                </h4>
                <p class="text-xs text-slate-500 mt-0.5">Sebelum 12:00 WIB</p>
            </div>
        </div>

        <!-- Guest count & Price Summary -->
        <div class="py-6 space-y-3">
            <div class="flex items-center justify-between text-sm">
                <span class="text-slate-500 dark:text-slate-400">Kapasitas Pesanan:</span>
                <span class="font-bold text-slate-900 dark:text-white">{{ $booking->guest_count }} Tamu</span>
            </div>

            <div class="flex items-center justify-between text-sm">
                <span class="text-slate-500 dark:text-slate-400">Total Biaya Penginapan:</span>
                <span class="text-xl font-extrabold text-emerald-600 dark:text-emerald-400">
                    Rp{{ number_format($booking->total_price, 0, ',', '.') }}
                </span>
            </div>
        </div>

        <!-- Actions -->
        <div class="pt-6 border-t border-slate-100 dark:border-slate-700 flex items-center justify-between gap-4">
            <a href="/bookings" class="px-5 py-2.5 rounded-xl bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-200 font-bold text-xs hover:bg-slate-200 transition-all">
                &larr; Kembali Ke Riwayat
            </a>

            @if($booking->status !== 'cancelled')
                <form method="post" action="{{ route('bookings.update', $booking) }}" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?');">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="cancelled">
                    <button type="submit" class="px-5 py-2.5 rounded-xl bg-rose-50 dark:bg-rose-950/60 text-rose-600 dark:text-rose-400 border border-rose-200 dark:border-rose-800 font-bold text-xs hover:bg-rose-600 hover:text-white transition-all">
                        Batalkan Booking
                    </button>
                </form>
            @endif
        </div>

    </div>
</x-layout>
