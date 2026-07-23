<x-layout>
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">Riwayat Booking</h1>
        <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Daftar seluruh pemesanan penginapan dan status konfirmasi Anda.</p>
    </div>

    @if($bookings->count() > 0)
        <div class="space-y-6 mb-10">
            @foreach($bookings as $booking)
                <div class="bg-white dark:bg-slate-800 rounded-3xl p-6 border border-slate-200/80 dark:border-slate-700 shadow-soft">
                    
                    <!-- Header Info -->
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-slate-100 dark:border-slate-700">
                        <div>
                            <span class="text-xs font-semibold text-slate-400">Kode Booking #{{ $booking->id }}</span>
                            <h3 class="text-lg font-extrabold text-slate-900 dark:text-white hover:text-emerald-600 transition-colors">
                                <a href="{{ route('bookings.show', $booking) }}">
                                    {{ $booking->property->name }}
                                </a>
                            </h3>
                        </div>

                        <div class="flex items-center gap-3">
                            <x-status-badge :status="$booking->status" />
                            
                            <a href="{{ route('bookings.show', $booking) }}" class="px-3.5 py-1.5 rounded-xl bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-200 hover:bg-emerald-600 hover:text-white dark:hover:bg-emerald-500 text-xs font-bold transition-all">
                                Detail Booking
                            </a>
                        </div>
                    </div>

                    <!-- Booking Details Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-4 text-xs">
                        <div>
                            <span class="text-slate-400 font-medium">Tanggal Menginap</span>
                            <p class="font-extrabold text-slate-800 dark:text-slate-200 text-sm mt-0.5">
                                {{ $booking->check_in->toDateString() }} &rarr; {{ $booking->check_out->toDateString() }}
                            </p>
                        </div>

                        <div>
                            <span class="text-slate-400 font-medium">Jumlah Tamu</span>
                            <p class="font-extrabold text-slate-800 dark:text-slate-200 text-sm mt-0.5">
                                {{ $booking->guest_count }} Tamu
                            </p>
                        </div>

                        <div>
                            <span class="text-slate-400 font-medium">Total Pembayaran</span>
                            <p class="font-extrabold text-emerald-600 dark:text-emerald-400 text-base mt-0.5">
                                Rp{{ number_format($booking->total_price, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>

                    <!-- Review Form if Completed and no Review yet -->
                    @if($booking->status === 'completed' && !$booking->review)
                        <div class="mt-6 pt-5 border-t border-dashed border-slate-200 dark:border-slate-700">
                            <h4 class="font-bold text-sm text-slate-900 dark:text-white mb-2 flex items-center gap-2">
                                <i data-lucide="star" class="w-4 h-4 text-amber-400 fill-amber-400"></i>
                                <span>Beri Ulasan Untuk Penginapan Ini</span>
                            </h4>

                            <form method="post" action="{{ route('reviews.store') }}" class="space-y-3 max-w-xl bg-slate-50 dark:bg-slate-900/60 p-4 rounded-2xl border border-slate-200/60 dark:border-slate-700/60">
                                @csrf
                                <input type="hidden" name="booking_id" value="{{ $booking->id }}">

                                <div>
                                    <label class="block text-xs font-semibold text-slate-600 dark:text-slate-300 mb-1">Rating Penilaian (1-5 Bintang)</label>
                                    <select name="rating" required class="w-full px-3 py-2 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-xs font-bold text-slate-800 dark:text-slate-200 outline-none">
                                        <option value="5">5 Bintang — Sangat Memuaskan</option>
                                        <option value="4">4 Bintang — Bagus</option>
                                        <option value="3">3 Bintang — Cukup</option>
                                        <option value="2">2 Bintang — Kurang</option>
                                        <option value="1">1 Bintang — Buruk</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-xs font-semibold text-slate-600 dark:text-slate-300 mb-1">Ulasan / Komentar</label>
                                    <textarea name="comment" required placeholder="Bagikan pengalaman menginap Anda di sini..." rows="2" 
                                              class="w-full px-3 py-2 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-xs font-medium text-slate-800 dark:text-slate-200 outline-none"></textarea>
                                </div>

                                <button type="submit" class="px-5 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-md transition-all">
                                    Kirim Review
                                </button>
                            </form>
                        </div>
                    @elseif($booking->review)
                        <div class="mt-4 pt-3 border-t border-slate-100 dark:border-slate-700/60 text-xs text-slate-500">
                            <span class="font-bold text-emerald-600 dark:text-emerald-400">✓ Ulasan Telah Dikirim:</span> "{{ $booking->review->comment }}" (Rating: {{ $booking->review->rating }}/5)
                        </div>
                    @endif

                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white dark:bg-slate-800 rounded-3xl p-12 text-center border border-slate-200 dark:border-slate-700 shadow-soft">
            <i data-lucide="receipt" class="w-12 h-12 text-slate-400 mx-auto mb-3"></i>
            <h3 class="font-bold text-lg text-slate-800 dark:text-slate-200">Belum Ada Riwayat Pemesanan</h3>
            <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Anda belum melakukan reservasi penginapan apapun.</p>
            <a href="/properties" class="mt-4 inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-emerald-600 text-white font-bold text-xs shadow-md">
                Cari Penginapan Sekarang
            </a>
        </div>
    @endif
</x-layout>
