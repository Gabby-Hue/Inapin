<x-layout>
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">Manajemen Pengguna</h1>
        <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Daftar pengguna terdaftar pada platform Inapin.</p>
    </div>

    <div class="space-y-3 mb-10">
        @foreach($users as $user)
            <div class="bg-white dark:bg-slate-800 rounded-2xl p-4 border border-slate-200/80 dark:border-slate-700 shadow-soft flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-emerald-600 text-white font-bold text-sm flex items-center justify-center">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div>
                        <h4 class="font-bold text-sm text-slate-900 dark:text-white">{{ $user->name }}</h4>
                        <span class="text-xs text-slate-400">{{ $user->email }}</span>
                    </div>
                </div>

                <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-200">
                    {{ $user->role }}
                </span>
            </div>
        @endforeach
    </div>
</x-layout>
