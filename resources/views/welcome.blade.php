<x-layout>
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
            </div>
        </div>
    </section>

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
</x-layout>
