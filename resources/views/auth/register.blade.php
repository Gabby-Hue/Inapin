<x-layout>
    <div class="max-w-3xl mx-auto my-6 bg-white dark:bg-slate-800 rounded-3xl p-6 sm:p-10 border border-slate-200/80 dark:border-slate-700 shadow-soft-lg">
        
        <div class="mb-6">
            <h1 class="text-2xl font-extrabold text-slate-900 dark:text-white">Daftar Akun Baru</h1>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Bergabung bersama Inapin sebagai wisatawan atau penyedia penginapan (partner).</p>
        </div>

        <form method="post" action="/register" class="space-y-4">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Nama Lengkap</label>
                    <div class="relative">
                        <i data-lucide="user" class="w-4 h-4 absolute left-3.5 top-3 text-slate-400"></i>
                        <input name="name" value="{{ old('name') }}" required placeholder="Nama Anda"
                               class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-sm font-medium focus:ring-2 focus:ring-emerald-500 outline-none transition-all">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Email</label>
                    <div class="relative">
                        <i data-lucide="mail" class="w-4 h-4 absolute left-3.5 top-3 text-slate-400"></i>
                        <input name="email" type="email" value="{{ old('email') }}" required placeholder="nama@email.com"
                               class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-sm font-medium focus:ring-2 focus:ring-emerald-500 outline-none transition-all">
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Nomor Telepon</label>
                    <div class="relative">
                        <i data-lucide="phone" class="w-4 h-4 absolute left-3.5 top-3 text-slate-400"></i>
                        <input name="phone" value="{{ old('phone') }}" placeholder="08123456789"
                               class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-sm font-medium focus:ring-2 focus:ring-emerald-500 outline-none transition-all">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Tipe Akun</label>
                    <div class="relative">
                        <i data-lucide="shield" class="w-4 h-4 absolute left-3.5 top-3 text-slate-400"></i>
                        <select name="role" id="role-select" onchange="togglePartnerFields(this.value)" class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-sm font-medium focus:ring-2 focus:ring-emerald-500 outline-none transition-all appearance-none">
                            <option value="user" @selected(old('role') === 'user')>User (Wisatawan)</option>
                            <option value="partner" @selected(old('role') === 'partner')>Partner (Penyedia Penginapan)</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Partner Business Details Fields (Hidden if user role) -->
            <div id="partner-fields" class="{{ old('role') === 'partner' ? '' : 'hidden' }} p-4 rounded-2xl bg-emerald-50/50 dark:bg-emerald-950/30 border border-emerald-200/70 dark:border-emerald-800 space-y-3">
                <h4 class="font-bold text-xs text-emerald-800 dark:text-emerald-300 uppercase tracking-wider">Informasi Bisnis Partner</h4>
                
                <div>
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Nama Bisnis / Usaha</label>
                    <input name="business_name" value="{{ old('business_name') }}" placeholder="Contoh: Villa Ubud Bali Stay"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-sm font-medium focus:ring-2 focus:ring-emerald-500 outline-none">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Deskripsi Bisnis</label>
                    <textarea name="business_description" placeholder="Jelaskan mengenai akomodasi yang Anda tawarkan..." rows="2"
                              class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-sm font-medium focus:ring-2 focus:ring-emerald-500 outline-none">{{ old('business_description') }}</textarea>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Password</label>
                    <div class="relative">
                        <i data-lucide="lock" class="w-4 h-4 absolute left-3.5 top-3 text-slate-400"></i>
                        <input name="password" type="password" required placeholder="••••••••"
                               class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-sm font-medium focus:ring-2 focus:ring-emerald-500 outline-none transition-all">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Konfirmasi Password</label>
                    <div class="relative">
                        <i data-lucide="check-circle" class="w-4 h-4 absolute left-3.5 top-3 text-slate-400"></i>
                        <input name="password_confirmation" type="password" required placeholder="••••••••"
                               class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-sm font-medium focus:ring-2 focus:ring-emerald-500 outline-none transition-all">
                    </div>
                </div>
            </div>

            <button type="submit" class="w-full py-3.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold text-sm shadow-md shadow-emerald-600/30 transition-all flex items-center justify-center gap-2 mt-4">
                <i data-lucide="user-plus" class="w-4 h-4"></i>
                <span>Daftar Sekarang</span>
            </button>

            <p class="text-center text-xs text-slate-500 dark:text-slate-400 pt-2">
                Sudah memiliki akun? <a href="/login" class="font-bold text-emerald-600 dark:text-emerald-400 hover:underline">Masuk di sini</a>
            </p>
        </form>
    </div>

    <script>
        function togglePartnerFields(role) {
            const fields = document.getElementById('partner-fields');
            if (role === 'partner') {
                fields.classList.remove('hidden');
            } else {
                fields.classList.add('hidden');
            }
        }
    </script>
</x-layout>
