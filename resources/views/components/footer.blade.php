<footer class="mt-auto bg-slate-900 text-slate-400 border-t border-slate-800 pt-14 pb-20 md:pb-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
            
            <!-- Brand Info -->
            <div class="space-y-4 md:col-span-1">
                <div class="flex items-center gap-2.5">
                    <div class="w-9 h-9 rounded-xl bg-emerald-500 flex items-center justify-center text-white">
                        <i data-lucide="compass" class="w-5 h-5"></i>
                    </div>
                    <span class="font-extrabold text-2xl tracking-tight text-white">Inapin</span>
                </div>
                <p class="text-sm leading-relaxed text-slate-400">
                    Platform pemesanan transportasi domestik dan penginapan terverifikasi di seluruh Indonesia dalam satu alur yang seamless.
                </p>
                <div class="flex items-center gap-3 pt-2">
                    <a href="#" class="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center hover:bg-emerald-600 hover:text-white transition-colors" aria-label="Instagram">
                        <i data-lucide="instagram" class="w-4 h-4"></i>
                    </a>
                    <a href="#" class="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center hover:bg-emerald-600 hover:text-white transition-colors" aria-label="Twitter">
                        <i data-lucide="twitter" class="w-4 h-4"></i>
                    </a>
                    <a href="#" class="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center hover:bg-emerald-600 hover:text-white transition-colors" aria-label="Facebook">
                        <i data-lucide="facebook" class="w-4 h-4"></i>
                    </a>
                </div>
            </div>

            <!-- Destinations Links -->
            <div>
                <h4 class="text-white font-semibold text-sm mb-4 tracking-wider uppercase">Destinasi Populer</h4>
                <ul class="space-y-2.5 text-sm">
                    <li><a href="/properties?city=Bali" class="hover:text-emerald-400 transition-colors">Penginapan di Bali</a></li>
                    <li><a href="/properties?city=Yogyakarta" class="hover:text-emerald-400 transition-colors">Resort Yogyakarta</a></li>
                    <li><a href="/properties?city=Lombok" class="hover:text-emerald-400 transition-colors">Villa di Lombok</a></li>
                    <li><a href="/properties?city=Labuan+Bajo" class="hover:text-emerald-400 transition-colors">Glamping Labuan Bajo</a></li>
                    <li><a href="/properties?city=Jakarta" class="hover:text-emerald-400 transition-colors">Hotel & Stay Jakarta</a></li>
                </ul>
            </div>

            <!-- Services -->
            <div>
                <h4 class="text-white font-semibold text-sm mb-4 tracking-wider uppercase">Layanan Travel</h4>
                <ul class="space-y-2.5 text-sm">
                    <li><a href="/properties" class="hover:text-emerald-400 transition-colors">Cari Penginapan</a></li>
                    <li><a href="/flights" class="hover:text-emerald-400 transition-colors">Tiket Pesawat Domestik</a></li>
                    <li><a href="/ferries" class="hover:text-emerald-400 transition-colors">Tiket Kapal Laut</a></li>
                    <li><a href="/register" class="hover:text-emerald-400 transition-colors">Gabung Sebagai Partner</a></li>
                </ul>
            </div>

            <!-- Support & Trust -->
            <div>
                <h4 class="text-white font-semibold text-sm mb-4 tracking-wider uppercase">Keamanan & Pembayaran</h4>
                <p class="text-sm mb-4 text-slate-400">Pembayaran terverifikasi aman dengan berbagai pilihan saluran instan.</p>
                <div class="flex flex-wrap gap-2 text-xs font-semibold">
                    <span class="px-2.5 py-1 rounded bg-slate-800 text-slate-300">Bank Transfer</span>
                    <span class="px-2.5 py-1 rounded bg-slate-800 text-slate-300">QRIS</span>
                    <span class="px-2.5 py-1 rounded bg-slate-800 text-slate-300">E-Wallet</span>
                    <span class="px-2.5 py-1 rounded bg-slate-800 text-slate-300">Virtual Account</span>
                </div>
            </div>

        </div>

        <div class="pt-8 border-t border-slate-800/80 flex flex-col md:flex-row items-center justify-between gap-4 text-xs">
            <p>&copy; {{ date('Y') }} Inapin Platform. Hak Cipta Dilindungi.</p>
            <div class="flex items-center gap-6">
                <a href="#" class="hover:text-slate-200">Syarat & Ketentuan</a>
                <a href="#" class="hover:text-slate-200">Kebijakan Privasi</a>
                <a href="#" class="hover:text-slate-200">Pusat Bantuan</a>
            </div>
        </div>
    </div>
</footer>
