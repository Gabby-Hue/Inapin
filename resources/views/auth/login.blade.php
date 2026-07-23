<x-layout>
    <div class="max-w-4xl mx-auto my-6 bg-white dark:bg-slate-800 rounded-3xl overflow-hidden border border-slate-200/80 dark:border-slate-700 shadow-soft-lg grid grid-cols-1 md:grid-cols-2">
        
        <!-- Left Hero Branding -->
        <div class="relative bg-gradient-to-br from-emerald-900 via-emerald-800 to-slate-900 p-8 sm:p-10 text-white flex flex-col justify-between hidden md:flex">
            <div class="relative z-10">
                <div class="flex items-center gap-2.5 mb-8">
                    <div class="w-10 h-10 rounded-2xl bg-emerald-500 flex items-center justify-center text-white">
                        <i data-lucide="compass" class="w-6 h-6"></i>
                    </div>
                    <span class="font-extrabold text-2xl tracking-tight">Inapin</span>
                </div>

                <h2 class="text-2xl font-extrabold leading-snug">Selamat Datang Kembali di Inapin</h2>
                <p class="text-emerald-100/80 text-xs mt-3 leading-relaxed">
                    Masuk ke akun Anda untuk melihat jadwal tiket perjalanan, e-voucher penginapan, dan mengelola reservasi.
                </p>
            </div>

            <div class="relative z-10 pt-6 border-t border-emerald-700/60 text-xs text-emerald-200">
                <p>Belum punya akun? <a href="/register" class="font-bold text-white underline hover:text-amber-300">Daftar sekarang</a></p>
            </div>

            <img src="https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=600&q=80" 
                 alt="Travel background" 
                 class="absolute inset-0 w-full h-full object-cover opacity-20">
        </div>

        <!-- Right Login Form -->
        <div class="p-8 sm:p-10 flex flex-col justify-center">
            <div class="mb-6">
                <h1 class="text-2xl font-extrabold text-slate-900 dark:text-white">Masuk Akun</h1>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Masukkan kredensial email dan kata sandi Anda.</p>
            </div>

            <form method="post" action="/login" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Email</label>
                    <div class="relative">
                        <i data-lucide="mail" class="w-4 h-4 absolute left-3.5 top-3 text-slate-400"></i>
                        <input name="email" type="email" required placeholder="nama@email.com"
                               class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-sm font-medium focus:ring-2 focus:ring-emerald-500 outline-none transition-all">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Password</label>
                    <div class="relative">
                        <i data-lucide="lock" class="w-4 h-4 absolute left-3.5 top-3 text-slate-400"></i>
                        <input name="password" type="password" required placeholder="••••••••"
                               class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-sm font-medium focus:ring-2 focus:ring-emerald-500 outline-none transition-all">
                    </div>
                </div>

                <button type="submit" class="w-full py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold text-sm shadow-md shadow-emerald-600/30 transition-all flex items-center justify-center gap-2">
                    <i data-lucide="log-in" class="w-4 h-4"></i>
                    <span>Masuk Ke Akun</span>
                </button>

                <p class="text-center text-xs text-slate-500 dark:text-slate-400 mt-4 md:hidden">
                    Belum punya akun? <a href="/register" class="font-bold text-emerald-600 dark:text-emerald-400 hover:underline">Daftar sekarang</a>
                </p>
            </form>
        </div>

    </div>
</x-layout>
