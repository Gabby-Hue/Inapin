<x-layout>
<<<<<<< HEAD
<div class="-m-6 overflow-hidden bg-slate-950 text-white" data-homepage-search>
    <section class="relative min-h-[760px] px-4 pb-16 pt-6 sm:px-8 lg:px-12">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,_rgba(14,165,233,0.45),_transparent_32%),linear-gradient(180deg,_rgba(2,6,23,0.18),_rgba(2,6,23,0.92)),url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1800&q=80')] bg-cover bg-center"></div>
        <div class="absolute inset-x-0 top-0 h-28 bg-gradient-to-b from-sky-950/80 to-transparent"></div>
        <div class="relative mx-auto max-w-7xl">
            <header class="flex flex-wrap items-center justify-between gap-4 rounded-full border border-white/10 bg-white/10 px-5 py-3 shadow-2xl shadow-sky-950/30 backdrop-blur-xl">
                <a href="/" class="flex items-center gap-3 text-2xl font-black tracking-tight">
                    <span class="grid h-11 w-11 place-items-center rounded-2xl bg-sky-400 text-slate-950 shadow-lg shadow-sky-400/30">✦</span>
                    Inapin
                </a>
                <nav class="hidden items-center gap-6 text-sm font-semibold text-white/85 md:flex">
                    <a class="hover:text-white" href="/properties">Hotel</a>
                    <a class="hover:text-white" href="/flights">Tiket Pesawat</a>
                    <a class="hover:text-white" href="/ferries">Kapal</a>
                    <a class="hover:text-white" href="#deals">Promo</a>
                </nav>
                <div class="flex items-center gap-3 text-sm font-bold">
                    @auth
                        <a href="/dashboard" class="rounded-full bg-white px-5 py-3 text-sky-700 shadow-lg transition hover:-translate-y-0.5">Dashboard</a>
                    @else
                        <a href="/login" class="rounded-full bg-white/15 px-5 py-3 text-white ring-1 ring-white/20 transition hover:bg-white/25">Log In</a>
                        <a href="/register" class="rounded-full bg-sky-400 px-5 py-3 text-slate-950 shadow-lg shadow-sky-500/30 transition hover:-translate-y-0.5 hover:bg-sky-300">Daftar</a>
                    @endauth
                </div>
            </header>

            <div class="mx-auto mt-16 max-w-4xl text-center">
                <p class="inline-flex items-center gap-2 rounded-full bg-white/15 px-4 py-2 text-sm font-bold text-sky-100 ring-1 ring-white/20 backdrop-blur">✨ Jelajahi Indonesia dengan cara yang lebih gampang</p>
                <h1 class="mt-6 text-4xl font-black leading-tight tracking-tight sm:text-6xl lg:text-7xl">Temukan staycation, trip, dan tiket favoritmu.</h1>
                <p class="mx-auto mt-5 max-w-2xl text-lg text-slate-100">Cari kota tujuan, pilih tanggal trip, atur kamar dan tamu, lalu biarkan Inapin menyiapkan rekomendasi akomodasi lokal yang siap dipesan.</p>
            </div>

            <div class="mt-12 rounded-[2rem] border border-white/15 bg-slate-950/35 p-4 shadow-2xl shadow-slate-950/40 backdrop-blur-xl lg:p-6">
                <div class="grid grid-cols-2 gap-3 text-center text-sm font-extrabold sm:grid-cols-4 lg:grid-cols-7" data-service-tabs>
                    @foreach ([['Hotel','🏨'], ['Pesawat','✈️'], ['Kapal','⛴️'], ['Villa','🏡'], ['Glamping','⛺'], ['Atraksi','🎡'], ['Lainnya','⋯']] as $index => [$label, $icon])
                        <button type="button" class="service-tab rounded-3xl px-4 py-4 transition hover:-translate-y-1 {{ $index === 0 ? 'active bg-white text-slate-950 shadow-xl' : 'bg-white/10 text-white/80 hover:bg-white/20' }}" data-service="{{ $label }}">
                            <span class="block text-3xl">{{ $icon }}</span>
                            <span class="mt-2 block">{{ $label }}</span>
                        </button>
                    @endforeach
                </div>

                <div class="mt-6 h-px bg-white/25"></div>

                <form action="/properties" method="get" class="mt-6 overflow-hidden rounded-[1.75rem] bg-white text-slate-900 shadow-2xl" data-trip-form>
                    <div class="grid lg:grid-cols-[1.2fr_1fr_1fr_auto]">
                        <label class="group border-b border-slate-200 p-5 lg:border-b-0 lg:border-r">
                            <span class="text-sm font-black text-slate-500">Kota, tujuan, atau nama hotel</span>
                            <span class="mt-3 flex items-center gap-3 rounded-2xl bg-slate-50 px-4 py-4 ring-2 ring-transparent transition group-focus-within:ring-sky-300">
                                <span class="text-3xl text-sky-500">⌖</span>
                                <input name="destination" data-destination-input class="w-full bg-transparent text-lg font-bold outline-none placeholder:text-slate-400" placeholder="Jakarta, Bali, Lombok..." value="Bali">
                            </span>
                        </label>
                        <label class="border-b border-slate-200 p-5 lg:border-b-0 lg:border-r">
                            <span class="text-sm font-black text-slate-500">Tanggal Trip</span>
                            <span class="mt-3 flex items-center gap-3 rounded-2xl bg-slate-50 px-4 py-4">
                                <span class="text-3xl text-sky-500">🗓️</span>
                                <input name="check_in" type="date" class="w-full bg-transparent text-base font-bold outline-none" value="2026-07-08">
                                <input name="check_out" type="date" class="w-full bg-transparent text-base font-bold outline-none" value="2026-07-09">
                            </span>
                        </label>
                        <div class="border-b border-slate-200 p-5 lg:border-b-0 lg:border-r">
                            <p class="text-sm font-black text-slate-500">Tamu dan Kamar</p>
                            <div class="mt-3 space-y-3 rounded-2xl bg-slate-50 p-3">
                                @foreach ([['Dewasa','adults',2], ['Anak','children',0], ['Kamar','rooms',1]] as [$label, $name, $value])
                                    <div class="flex items-center justify-between gap-3">
                                        <span class="font-bold">{{ $label }}</span>
                                        <div class="flex items-center gap-2">
                                            <button type="button" class="counter-btn" data-counter-minus="{{ $name }}">−</button>
                                            <input readonly name="{{ $name }}" value="{{ $value }}" class="w-8 bg-transparent text-center font-black" data-counter="{{ $name }}">
                                            <button type="button" class="counter-btn" data-counter-plus="{{ $name }}">+</button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <button class="m-5 rounded-3xl bg-orange-500 px-8 py-5 text-lg font-black text-white shadow-xl shadow-orange-500/30 transition hover:-translate-y-1 hover:bg-orange-400">Cari Sekarang</button>
                    </div>
                </form>

                <div class="mt-5 flex flex-wrap gap-3 text-sm font-bold">
                    @foreach (['Dekat saya', 'Bali beachfront', 'Bandung keluarga', 'Lombok honeymoon'] as $tag)
                        <button type="button" class="destination-chip rounded-full bg-white/15 px-4 py-2 text-white ring-1 ring-white/20 transition hover:bg-sky-400 hover:text-slate-950" data-destination="{{ $tag }}">{{ $tag }}</button>
                    @endforeach
                </div>
=======
    <!-- Hero Section -->
    <section class="relative rounded-3xl overflow-hidden mb-12 shadow-soft-lg">
        <!-- Background Gradient / Image Overlay -->
        <div class="absolute inset-0 bg-gradient-to-r from-emerald-950/90 via-emerald-900/80 to-slate-900/90 z-10"></div>
        <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1800&q=80" 
             alt="Indonesian Destination Background" 
             class="absolute inset-0 w-full h-full object-cover">

        <!-- Hero Content -->
        <div class="relative z-20 px-6 py-16 sm:px-12 sm:py-20 max-w-4xl">
            <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/10 backdrop-blur-md text-emerald-300 border border-white/20 text-xs font-bold mb-4 tracking-wide uppercase">
                <i data-lucide="sparkles" class="w-4 h-4 text-amber-400"></i>
                Pilihan Utama Travel Domestik
            </span>
            
            <h1 class="text-3xl sm:text-5xl font-extrabold text-white tracking-tight leading-tight">
                Jelajahi Keindahan Nusantara Dalam Satu Alur.
            </h1>
            
            <p class="mt-4 text-base sm:text-lg text-emerald-100/90 leading-relaxed max-w-2xl font-normal">
                Temukan penginapan lokal terverifikasi, serta pesan tiket pesawat dan kapal laut antar pulau Indonesia secara praktis dan aman.
            </p>

            <!-- Interactive Tabbed Search Bar Widget -->
            <div class="mt-8 bg-white dark:bg-slate-800/95 backdrop-blur-xl p-4 sm:p-6 rounded-2xl shadow-xl border border-white/20 dark:border-slate-700 text-slate-900 dark:text-white">
                
                <!-- Search Tabs Header -->
                <div class="flex items-center gap-2 mb-4 border-b border-slate-100 dark:border-slate-700/60 pb-3">
                    <button type="button" onclick="switchSearchTab('stay')" id="tab-btn-stay" class="search-tab-btn flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-bold transition-all bg-emerald-600 text-white shadow-sm">
                        <i data-lucide="building-2" class="w-4 h-4"></i>
                        <span>Cari Penginapan</span>
                    </button>
                    <button type="button" onclick="switchSearchTab('flight')" id="tab-btn-flight" class="search-tab-btn flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-bold text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 transition-all">
                        <i data-lucide="plane" class="w-4 h-4"></i>
                        <span>Cari Pesawat</span>
                    </button>
                    <button type="button" onclick="switchSearchTab('ferry')" id="tab-btn-ferry" class="search-tab-btn flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-bold text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 transition-all">
                        <i data-lucide="ship" class="w-4 h-4"></i>
                        <span>Cari Kapal Laut</span>
                    </button>
                </div>

                <!-- Stay Search Form -->
                <form action="/properties" method="GET" id="search-form-stay" class="grid grid-cols-1 md:grid-cols-4 gap-3">
                    <div class="md:col-span-2">
                        <label class="block text-[11px] font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1">Destinasi / Kota</label>
                        <div class="relative">
                            <i data-lucide="map-pin" class="w-4 h-4 absolute left-3.5 top-3 text-slate-400"></i>
                            <input type="text" name="city" placeholder="Mau menginap di mana? (misal: Bali, Yogyakarta)" 
                                   class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-sm font-medium focus:ring-2 focus:ring-emerald-500 outline-none transition-all">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[11px] font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1">Kategori</label>
                        <div class="relative">
                            <i data-lucide="home" class="w-4 h-4 absolute left-3.5 top-3 text-slate-400"></i>
                            <select name="category" class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-sm font-medium focus:ring-2 focus:ring-emerald-500 outline-none transition-all appearance-none">
                                <option value="">Semua Kategori</option>
                                @foreach(\App\Models\Property::CATEGORIES as $category)
                                    <option value="{{ $category }}">{{ $category }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="flex items-end">
                        <button type="submit" class="w-full py-2.5 px-6 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm shadow-md shadow-emerald-600/30 flex items-center justify-center gap-2 transition-all">
                            <i data-lucide="search" class="w-4 h-4"></i>
                            <span>Cari Penginapan</span>
                        </button>
                    </div>
                </form>

                <!-- Flight Search Form -->
                <form action="/flights/search" method="GET" id="search-form-flight" class="hidden grid grid-cols-1 md:grid-cols-3 gap-3">
                    <div>
                        <label class="block text-[11px] font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1">Kota / Bandara Asal</label>
                        <div class="relative">
                            <i data-lucide="plane-takeoff" class="w-4 h-4 absolute left-3.5 top-3 text-slate-400"></i>
                            <input type="text" name="origin" placeholder="Kota atau Kode (misal: Jakarta / CGK)" 
                                   class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-sm font-medium focus:ring-2 focus:ring-emerald-500 outline-none transition-all">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[11px] font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1">Kota / Bandara Tujuan</label>
                        <div class="relative">
                            <i data-lucide="plane-landing" class="w-4 h-4 absolute left-3.5 top-3 text-slate-400"></i>
                            <input type="text" name="destination" placeholder="Kota atau Kode (misal: Bali / DPS)" 
                                   class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-sm font-medium focus:ring-2 focus:ring-emerald-500 outline-none transition-all">
                        </div>
                    </div>

                    <div class="flex items-end">
                        <button type="submit" class="w-full py-2.5 px-6 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm shadow-md shadow-emerald-600/30 flex items-center justify-center gap-2 transition-all">
                            <i data-lucide="search" class="w-4 h-4"></i>
                            <span>Cari Penerbangan</span>
                        </button>
                    </div>
                </form>

                <!-- Ferry Search Form -->
                <form action="/ferries/search" method="GET" id="search-form-ferry" class="hidden grid grid-cols-1 md:grid-cols-3 gap-3">
                    <div>
                        <label class="block text-[11px] font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1">Pelabuhan / Kota Asal</label>
                        <div class="relative">
                            <i data-lucide="anchor" class="w-4 h-4 absolute left-3.5 top-3 text-slate-400"></i>
                            <input type="text" name="origin" placeholder="Pelabuhan atau Kota asal (misal: Tanjung Priok)" 
                                   class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-sm font-medium focus:ring-2 focus:ring-emerald-500 outline-none transition-all">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[11px] font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1">Pelabuhan / Kota Tujuan</label>
                        <div class="relative">
                            <i data-lucide="navigation" class="w-4 h-4 absolute left-3.5 top-3 text-slate-400"></i>
                            <input type="text" name="destination" placeholder="Pelabuhan atau Kota tujuan (misal: Benoa)" 
                                   class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-sm font-medium focus:ring-2 focus:ring-emerald-500 outline-none transition-all">
                        </div>
                    </div>

                    <div class="flex items-end">
                        <button type="submit" class="w-full py-2.5 px-6 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm shadow-md shadow-emerald-600/30 flex items-center justify-center gap-2 transition-all">
                            <i data-lucide="search" class="w-4 h-4"></i>
                            <span>Cari Jadwal Kapal</span>
                        </button>
                    </div>
                </form>

>>>>>>> ae83ba3 (UI/UX overhaul and design updates)
            </div>
        </div>
    </section>

<<<<<<< HEAD
    <section id="deals" class="relative bg-slate-50 px-4 py-16 text-slate-900 sm:px-8 lg:px-12">
        <div class="mx-auto grid max-w-7xl gap-6 md:grid-cols-3">
            @foreach ([['Flash Deal Hotel','Diskon sampai 45% untuk penginapan partner lokal pilihan.','bg-sky-500'], ['Trip Keluarga','Rekomendasi kamar luas, child-friendly, dan dekat atraksi.','bg-emerald-500'], ['Island Escape','Paket kapal + cottage untuk liburan pulau yang santai.','bg-orange-500']] as [$title, $copy, $color])
                <article class="group overflow-hidden rounded-[2rem] bg-white p-6 shadow-xl shadow-slate-200 transition hover:-translate-y-2">
                    <div class="h-36 rounded-[1.5rem] {{ $color }} bg-gradient-to-br from-white/30 to-transparent"></div>
                    <h2 class="mt-5 text-2xl font-black">{{ $title }}</h2>
                    <p class="mt-2 text-slate-600">{{ $copy }}</p>
                    <a href="/properties" class="mt-5 inline-flex font-black text-sky-600">Lihat promo →</a>
                </article>
            @endforeach
        </div>
    </section>
</div>
=======
    <!-- Categories Pills Horizontal Bar -->
    <section class="mb-12">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                <i data-lucide="layout-grid" class="w-5 h-5 text-emerald-600"></i>
                Kategori Penginapan
            </h2>
            <a href="/properties" class="text-xs font-bold text-emerald-600 dark:text-emerald-400 hover:underline flex items-center gap-1">
                <span>Lihat Semua</span>
                <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
            </a>
        </div>

        <div class="flex items-center gap-3 overflow-x-auto pb-2 scrollbar-none">
            <a href="/properties" class="shrink-0 flex items-center gap-2 px-5 py-3 rounded-2xl bg-emerald-600 text-white font-semibold text-xs shadow-md shadow-emerald-600/20">
                <i data-lucide="grid" class="w-4 h-4"></i>
                <span>Semua</span>
            </a>
            @foreach(\App\Models\Property::CATEGORIES as $cat)
                <a href="/properties?category={{ urlencode($cat) }}" class="shrink-0 flex items-center gap-2.5 px-5 py-3 rounded-2xl bg-white dark:bg-slate-800 border border-slate-200/80 dark:border-slate-700 text-slate-700 dark:text-slate-200 font-semibold text-xs hover:border-emerald-500 hover:text-emerald-600 dark:hover:text-emerald-400 transition-all shadow-xs">
                    <i data-lucide="home" class="w-4 h-4 text-emerald-600"></i>
                    <span>{{ $cat }}</span>
                </a>
            @endforeach
        </div>
    </section>

    <!-- Popular Destinations Grid -->
    <section class="mb-12">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Destinasi Favorit Wisatawan</h2>
            <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Jelajahi tempat tinggal paling populer untuk liburan seru Anda selanjutnya.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            @php
                $destinations = [
                    ['name' => 'Bali', 'desc' => 'Pantai, Persawahan & Villa Mewah', 'img' => 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=600&q=80'],
                    ['name' => 'Yogyakarta', 'desc' => 'Budaya, Warisan & Homestay', 'img' => 'https://images.unsplash.com/photo-1584810359583-96fc3448beaa?auto=format&fit=crop&w=600&q=80'],
                    ['name' => 'Lombok', 'desc' => 'Gili, Laut Biru & Resort', 'img' => 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=600&q=80'],
                    ['name' => 'Labuan Bajo', 'desc' => 'Pulau Komodo & Glamping', 'img' => 'https://images.unsplash.com/photo-1516690561799-46d8f74f9abf?auto=format&fit=crop&w=600&q=80']
                ];
            @endphp

            @foreach($destinations as $dest)
                <a href="/properties?city={{ urlencode($dest['name']) }}" class="group relative rounded-2xl overflow-hidden aspect-4/5 shadow-soft hover:shadow-soft-lg transition-all duration-300">
                    <img src="{{ $dest['img'] }}" alt="{{ $dest['name'] }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-slate-950/30 to-transparent"></div>
                    <div class="absolute bottom-4 left-4 right-4 text-white">
                        <span class="text-[11px] font-bold uppercase tracking-wider text-emerald-400">Destinasi</span>
                        <h3 class="text-xl font-extrabold group-hover:text-emerald-300 transition-colors">{{ $dest['name'] }}</h3>
                        <p class="text-xs text-slate-300 line-clamp-1 mt-0.5">{{ $dest['desc'] }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    <!-- Featured Properties Section -->
    <section class="mb-12">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Rekomendasi Penginapan Terbaik</h2>
                <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Pilihan properti lokal terverifikasi dengan pelayanan istimewa.</p>
            </div>
            <a href="/properties" class="hidden sm:flex items-center gap-1 text-sm font-bold text-emerald-600 dark:text-emerald-400 hover:underline">
                <span>Jelajahi Properti</span>
                <i data-lucide="chevron-right" class="w-4 h-4"></i>
            </a>
        </div>

        @php
            try {
                $featuredProperties = \App\Models\Property::where('status', 'approved')->with('images', 'reviews')->take(6)->get();
            } catch (\Throwable $e) {
                $featuredProperties = collect();
            }
        @endphp

        @if($featuredProperties->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($featuredProperties as $prop)
                    <x-property-card :property="$prop" />
                @endforeach
            </div>
        @else
            <div class="bg-white dark:bg-slate-800 rounded-2xl p-8 text-center border border-slate-200 dark:border-slate-700 shadow-soft">
                <i data-lucide="building-2" class="w-12 h-12 text-slate-400 mx-auto mb-3"></i>
                <h3 class="font-bold text-lg text-slate-800 dark:text-slate-200">Belum Ada Properti Disetujui</h3>
                <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Silakan cek kembali nanti atau daftarkan properti Anda sebagai partner.</p>
            </div>
        @endif
    </section>

    <!-- Why Choose Inapin Section -->
    <section class="rounded-3xl bg-slate-900 text-white p-8 sm:p-12 mb-12 relative overflow-hidden shadow-soft-lg">
        <div class="max-w-xl">
            <span class="text-xs font-bold text-amber-400 uppercase tracking-widest">Keunggulan Inapin</span>
            <h2 class="text-2xl sm:text-3xl font-extrabold mt-2 leading-snug">Satu Platform Untuk Seluruh Perjalanan Anda</h2>
            <p class="text-slate-400 text-sm mt-3 leading-relaxed">
                Kami menghubungkan tiket perjalanan pesawat, kapal laut, hingga tempat menginap terbaik tanpa kerumitan.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
            <div class="bg-slate-800/80 backdrop-blur-md p-6 rounded-2xl border border-slate-700/60">
                <div class="w-12 h-12 rounded-xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center mb-4">
                    <i data-lucide="shield-check" class="w-6 h-6"></i>
                </div>
                <h4 class="font-bold text-white text-base">Partner Terverifikasi</h4>
                <p class="text-slate-400 text-xs mt-2 leading-relaxed">Semua tempat menginap dan rute perjalanan telah dimoderasi secara ketat demi kenyamanan Anda.</p>
            </div>

            <div class="bg-slate-800/80 backdrop-blur-md p-6 rounded-2xl border border-slate-700/60">
                <div class="w-12 h-12 rounded-xl bg-amber-500/20 text-amber-400 flex items-center justify-center mb-4">
                    <i data-lucide="zap" class="w-6 h-6"></i>
                </div>
                <h4 class="font-bold text-white text-base">Pemesanan Instan</h4>
                <p class="text-slate-400 text-xs mt-2 leading-relaxed">Konfirmasi pesanan langsung dengan perhitungan transparan tanpa biaya tersembunyi.</p>
            </div>

            <div class="bg-slate-800/80 backdrop-blur-md p-6 rounded-2xl border border-slate-700/60">
                <div class="w-12 h-12 rounded-xl bg-teal-500/20 text-teal-400 flex items-center justify-center mb-4">
                    <i data-lucide="compass" class="w-6 h-6"></i>
                </div>
                <h4 class="font-bold text-white text-base">Jelajah Domestik</h4>
                <p class="text-slate-400 text-xs mt-2 leading-relaxed">Dukungan penuh untuk opsi rute penerbangan dan kapal antar-pulau terlengkap.</p>
            </div>
        </div>
    </section>

    <!-- Client-side Tab Switcher Script -->
    <script>
        function switchSearchTab(tabName) {
            const tabs = ['stay', 'flight', 'ferry'];
            tabs.forEach(t => {
                const form = document.getElementById('search-form-' + t);
                const btn = document.getElementById('tab-btn-' + t);
                if (t === tabName) {
                    form.classList.remove('hidden');
                    btn.className = 'search-tab-btn flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-bold transition-all bg-emerald-600 text-white shadow-sm';
                } else {
                    form.classList.add('hidden');
                    btn.className = 'search-tab-btn flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-bold text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 transition-all';
                }
            });
        }
    </script>
>>>>>>> ae83ba3 (UI/UX overhaul and design updates)
</x-layout>
