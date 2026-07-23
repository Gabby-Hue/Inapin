<!doctype html>
<html lang="id" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Inapin — Premium Travel & Stay Booking' }}</title>
    
    <!-- Dark mode early inline script to prevent flash of white theme -->
    <script>
        if (localStorage.getItem('inapin-theme') === 'dark' || (!('inapin-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
    
    <!-- Lucide Icons CDN -->
    <script src="https://unpkg.com/lucide@latest"></script>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-full flex flex-col bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-slate-100 antialiased selection:bg-emerald-500 selection:text-white transition-colors duration-300">

    <!-- Sticky Navigation Header -->
    <header class="sticky top-0 z-40 w-full glass-panel border-b border-slate-200/80 dark:border-slate-800/80 shadow-xs transition-colors">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between gap-4">
            
            <!-- Brand Logo -->
            <a href="/" class="flex items-center gap-2.5 group">
                <div class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-emerald-600 via-emerald-500 to-teal-400 flex items-center justify-center text-white shadow-md shadow-emerald-500/20 group-hover:scale-105 transition-transform duration-200">
                    <i data-lucide="compass" class="w-6 h-6 animate-pulse-glow"></i>
                </div>
                <div class="flex flex-col">
                    <span class="font-extrabold text-2xl tracking-tight bg-gradient-to-r from-emerald-700 via-emerald-600 to-teal-600 dark:from-emerald-400 dark:to-teal-300 bg-clip-text text-transparent">
                        Inapin
                    </span>
                    <span class="text-[10px] font-semibold text-slate-500 dark:text-slate-400 -mt-1 tracking-wider uppercase">Travel & Stays</span>
                </div>
            </a>

            <!-- Desktop Nav Links -->
            <nav class="hidden md:flex items-center gap-1.5 bg-slate-100/80 dark:bg-slate-800/80 p-1.5 rounded-full border border-slate-200/60 dark:border-slate-700/50">
                <a href="/properties" class="flex items-center gap-2 px-4 py-2 rounded-full text-sm font-semibold transition-all duration-200 {{ request()->is('properties*') ? 'bg-white dark:bg-slate-700 text-emerald-600 dark:text-emerald-400 shadow-sm' : 'text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white' }}">
                    <i data-lucide="building-2" class="w-4 h-4"></i>
                    <span>Penginapan</span>
                </a>
                <a href="/flights" class="flex items-center gap-2 px-4 py-2 rounded-full text-sm font-semibold transition-all duration-200 {{ request()->is('flights*') ? 'bg-white dark:bg-slate-700 text-emerald-600 dark:text-emerald-400 shadow-sm' : 'text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white' }}">
                    <i data-lucide="plane" class="w-4 h-4"></i>
                    <span>Pesawat</span>
                </a>
                <a href="/ferries" class="flex items-center gap-2 px-4 py-2 rounded-full text-sm font-semibold transition-all duration-200 {{ request()->is('ferries*') ? 'bg-white dark:bg-slate-700 text-emerald-600 dark:text-emerald-400 shadow-sm' : 'text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white' }}">
                    <i data-lucide="ship" class="w-4 h-4"></i>
                    <span>Kapal</span>
                </a>
            </nav>

            <!-- Right Actions & User Controls -->
            <div class="flex items-center gap-3">
                
                <!-- Dark Mode Toggle Button -->
                <button type="button" class="theme-toggle-btn p-2.5 rounded-full text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors" title="Toggle Dark/Light Mode" aria-label="Toggle Mode">
                    <i data-lucide="sun" class="w-5 h-5 hidden dark:block text-amber-400"></i>
                    <i data-lucide="moon" class="w-5 h-5 block dark:hidden text-slate-600"></i>
                </button>

                @auth
                    <!-- User Auth Dropdown/Links -->
                    <a href="/favorites" class="hidden sm:flex items-center justify-center p-2.5 rounded-full text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-rose-500 dark:hover:text-rose-400 transition-colors" title="Favorit Saya">
                        <i data-lucide="heart" class="w-5 h-5"></i>
                    </a>

                    <div class="flex items-center gap-2 pl-2 border-l border-slate-200 dark:border-slate-700">
                        <a href="/dashboard" class="flex items-center gap-2 px-4 py-2 rounded-full text-sm font-semibold bg-emerald-50 text-emerald-700 hover:bg-emerald-100 dark:bg-emerald-950/50 dark:text-emerald-300 dark:hover:bg-emerald-900/50 transition-colors">
                            <i data-lucide="user-check" class="w-4 h-4"></i>
                            <span>{{ Auth::user()->name }}</span>
                        </a>

                        <form method="post" action="/logout" class="inline">
                            @csrf
                            <button type="submit" class="p-2 rounded-full text-slate-400 hover:text-rose-600 hover:bg-rose-50 dark:hover:bg-rose-950/30 transition-colors" title="Logout">
                                <i data-lucide="log-out" class="w-4 h-4"></i>
                            </button>
                        </form>
                    </div>
                @else
                    <div class="flex items-center gap-2">
                        <a href="/login" class="px-4 py-2 rounded-full text-sm font-semibold text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                            Masuk
                        </a>
                        <a href="/register" class="px-4 py-2 rounded-full text-sm font-semibold bg-emerald-600 hover:bg-emerald-700 text-white shadow-md shadow-emerald-600/20 hover:shadow-emerald-600/30 transition-all duration-200">
                            Daftar
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </header>

    <!-- Main Body Container -->
    <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8 animate-fade-in">

        <!-- Status Toast / Alert -->
        @if(session('status'))
            <div class="auto-dismiss-toast mb-6 p-4 rounded-2xl bg-emerald-50 dark:bg-emerald-950/60 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-200 flex items-center justify-between shadow-soft">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-emerald-500 text-white flex items-center justify-center shrink-0">
                        <i data-lucide="check-circle-2" class="w-5 h-5"></i>
                    </div>
                    <p class="font-medium text-sm">{{ session('status') }}</p>
                </div>
                <button onclick="this.parentElement.remove()" class="text-emerald-600 dark:text-emerald-400 hover:text-emerald-800 dark:hover:text-white">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>
        @endif

        <!-- Error Alerts -->
        @if($errors->any())
            <div class="mb-6 p-4 rounded-2xl bg-rose-50 dark:bg-rose-950/60 border border-rose-200 dark:border-rose-800 text-rose-800 dark:text-rose-200 shadow-soft">
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 rounded-full bg-rose-500 text-white flex items-center justify-center shrink-0 mt-0.5">
                        <i data-lucide="alert-triangle" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-sm">Terjadi Kesalahan</h4>
                        <ul class="mt-1 text-sm list-disc list-inside space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        {{ $slot ?? '' }}
        @yield('content')
    </main>

    <!-- Mobile Bottom Navigation -->
    <nav class="md:hidden fixed bottom-0 left-0 right-0 z-40 bg-white/90 dark:bg-slate-900/90 backdrop-blur-md border-t border-slate-200 dark:border-slate-800 px-3 py-2">
        <div class="flex items-center justify-around">
            <a href="/" class="flex flex-col items-center gap-1 text-xs font-medium {{ request()->is('/') ? 'text-emerald-600 dark:text-emerald-400' : 'text-slate-500 dark:text-slate-400' }}">
                <i data-lucide="home" class="w-5 h-5"></i>
                <span>Beranda</span>
            </a>
            <a href="/properties" class="flex flex-col items-center gap-1 text-xs font-medium {{ request()->is('properties*') ? 'text-emerald-600 dark:text-emerald-400' : 'text-slate-500 dark:text-slate-400' }}">
                <i data-lucide="building-2" class="w-5 h-5"></i>
                <span>Penginapan</span>
            </a>
            <a href="/flights" class="flex flex-col items-center gap-1 text-xs font-medium {{ request()->is('flights*') ? 'text-emerald-600 dark:text-emerald-400' : 'text-slate-500 dark:text-slate-400' }}">
                <i data-lucide="plane" class="w-5 h-5"></i>
                <span>Pesawat</span>
            </a>
            <a href="/ferries" class="flex flex-col items-center gap-1 text-xs font-medium {{ request()->is('ferries*') ? 'text-emerald-600 dark:text-emerald-400' : 'text-slate-500 dark:text-slate-400' }}">
                <i data-lucide="ship" class="w-5 h-5"></i>
                <span>Kapal</span>
            </a>
            @auth
                <a href="/dashboard" class="flex flex-col items-center gap-1 text-xs font-medium {{ request()->is('dashboard*') || request()->is('bookings*') ? 'text-emerald-600 dark:text-emerald-400' : 'text-slate-500 dark:text-slate-400' }}">
                    <i data-lucide="user" class="w-5 h-5"></i>
                    <span>Profil</span>
                </a>
            @else
                <a href="/login" class="flex flex-col items-center gap-1 text-xs font-medium {{ request()->is('login*') ? 'text-emerald-600 dark:text-emerald-400' : 'text-slate-500 dark:text-slate-400' }}">
                    <i data-lucide="log-in" class="w-5 h-5"></i>
                    <span>Masuk</span>
                </a>
            @endauth
        </div>
    </nav>

    <!-- Footer Component -->
    <x-footer />

    <!-- Lucide icons initialize script -->
    <script>
        lucide.createIcons();
    </script>
</body>
</html>
