<x-layout>
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">Booking Properti Masuk</h1>
        <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Kelola reservasi dan konfirmasi status kedatangan tamu.</p>
    </div>

    @if($bookings->count() > 0)
        <div class="space-y-4 mb-10">
            @foreach($bookings as $booking)
                <div class="bg-white dark:bg-slate-800 rounded-3xl p-6 border border-slate-200/80 dark:border-slate-700 shadow-soft flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <x-status-badge :status="$booking->status" />
                            <span class="text-xs font-semibold text-slate-400">Kode #{{ $booking->id }}</span>
                        </div>
                        
                        <h3 class="text-lg font-extrabold text-slate-900 dark:text-white">{{ $booking->property->name }}</h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
                            Tamu: <span class="font-bold text-slate-800 dark:text-slate-200">{{ $booking->user->name }}</span> ({{ $booking->guest_count }} orang) • 
                            Total: <span class="font-bold text-emerald-600 dark:text-emerald-400">Rp{{ number_format($booking->total_price, 0, ',', '.') }}</span>
                        </p>
                        <p class="text-xs text-slate-400 mt-0.5">
                            Tanggal: {{ $booking->check_in->toDateString() }} s/d {{ $booking->check_out->toDateString() }}
                        </p>
                    </div>

                    <!-- Status Update Form -->
                    <form method="post" action="{{ route('partner.bookings.update', $booking) }}" class="flex items-center gap-2 border-t md:border-t-0 pt-3 md:pt-0 border-slate-100 dark:border-slate-700">
                        @csrf
                        @method('PUT')
                        <select name="status" class="px-3 py-2 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-xs font-bold text-slate-800 dark:text-slate-200 outline-none">
                            @foreach(['pending','confirmed','completed','cancelled'] as $status)
                                <option value="{{ $status }}" @selected($booking->status === $status)>{{ ucfirst($status) }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-sm transition-all">
                            Update Status
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white dark:bg-slate-800 rounded-3xl p-12 text-center border border-slate-200 dark:border-slate-700 shadow-soft">
            <i data-lucide="inbox" class="w-12 h-12 text-slate-400 mx-auto mb-3"></i>
            <h3 class="font-bold text-lg text-slate-800 dark:text-slate-200">Belum Ada Booking Masuk</h3>
            <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Saat ini belum ada pemesanan dari wisatawan untuk properti Anda.</p>
        </div>
    @endif
</x-layout>
