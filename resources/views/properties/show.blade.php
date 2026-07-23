<x-layout>
    @php
        $fallbackImages = [
            'https://images.unsplash.com/photo-1580587771525-78b9dba3b914?auto=format&fit=crop&w=1200&q=80',
            'https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=800&q=80',
            'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=800&q=80',
            'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?auto=format&fit=crop&w=800&q=80',
        ];

        $galleryImages = [];
        if ($property->images && $property->images->count() > 0) {
            foreach($property->images as $img) {
                $galleryImages[] = asset('storage/' . $img->image_path);
            }
        }
        if (count($galleryImages) < 4) {
            $galleryImages = array_merge($galleryImages, array_slice($fallbackImages, 0, 4 - count($galleryImages)));
        }
    @endphp

    <!-- Breadcrumb Navigation -->
    <nav class="flex items-center gap-2 text-xs font-semibold text-slate-500 dark:text-slate-400 mb-4">
        <a href="/" class="hover:text-emerald-600 transition-colors">Beranda</a>
        <i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i>
        <a href="{{ route('properties.index') }}" class="hover:text-emerald-600 transition-colors">Penginapan</a>
        <i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i>
        <span class="text-slate-900 dark:text-white line-clamp-1">{{ $property->name }}</span>
    </nav>

    <!-- Property Header Title Bar -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
        <div>
            <div class="flex flex-wrap items-center gap-2 mb-2">
                <span class="px-3 py-1 rounded-full bg-emerald-100 dark:bg-emerald-950/80 text-emerald-800 dark:text-emerald-300 text-xs font-bold border border-emerald-200 dark:border-emerald-800">
                    {{ $property->category }}
                </span>
                <span class="px-3 py-1 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 text-xs font-medium flex items-center gap-1">
                    <i data-lucide="users" class="w-3.5 h-3.5 text-slate-500"></i>
                    <span>Kapasitas {{ $property->capacity }} tamu</span>
                </span>
            </div>
            
            <h1 class="text-2xl sm:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                {{ $property->name }}
            </h1>

            <div class="flex items-center gap-4 mt-2 text-sm text-slate-600 dark:text-slate-400">
                <div class="flex items-center gap-1.5 font-bold text-slate-900 dark:text-white">
                    <i data-lucide="star" class="w-4 h-4 fill-amber-400 text-amber-400"></i>
                    <span>{{ $property->average_rating ?? 'Baru' }}</span>
                    <span class="text-slate-400 font-normal">({{ $property->reviews->count() }} review)</span>
                </div>
                <span>•</span>
                <div class="flex items-center gap-1">
                    <i data-lucide="map-pin" class="w-4 h-4 text-emerald-600"></i>
                    <span>{{ $property->address }}, {{ $property->city }}</span>
                </div>
            </div>
        </div>

        @auth
            <!-- Favorite Form Action -->
            <form method="post" action="{{ route('favorites.store') }}">
                @csrf
                <input type="hidden" name="property_id" value="{{ $property->id }}">
                <button type="submit" class="px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 hover:bg-rose-50 dark:hover:bg-rose-950/30 text-slate-700 dark:text-slate-200 hover:text-rose-600 dark:hover:text-rose-400 text-sm font-bold shadow-xs transition-all flex items-center gap-2">
                    <i data-lucide="heart" class="w-4 h-4 text-rose-500"></i>
                    <span>Tambah Favorit</span>
                </button>
            </form>
        @endauth
    </div>

    <!-- Image Gallery Grid -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-3 rounded-3xl overflow-hidden mb-10 shadow-soft">
        <div class="md:col-span-2 aspect-16/10 md:aspect-auto h-72 md:h-96">
            <img src="{{ $galleryImages[0] }}" alt="{{ $property->name }}" class="w-full h-full object-cover hover:scale-102 transition-transform duration-500">
        </div>
        <div class="hidden md:grid grid-cols-1 gap-3 h-96">
            <img src="{{ $galleryImages[1] }}" alt="{{ $property->name }} thumbnail 1" class="w-full h-46 object-cover rounded-xl hover:opacity-90 transition-opacity">
            <img src="{{ $galleryImages[2] }}" alt="{{ $property->name }} thumbnail 2" class="w-full h-46 object-cover rounded-xl hover:opacity-90 transition-opacity">
        </div>
        <div class="hidden md:block h-96">
            <img src="{{ $galleryImages[3] }}" alt="{{ $property->name }} thumbnail 3" class="w-full h-full object-cover hover:opacity-90 transition-opacity">
        </div>
    </div>

    <!-- Main Content Layout (2 Column: Detail Info + Floating Booking Card) -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        
        <!-- Left Column: Details, Facilities & Reviews -->
        <div class="lg:col-span-2 space-y-10">
            
            <!-- Description Card -->
            <div class="bg-white dark:bg-slate-800 rounded-3xl p-6 sm:p-8 border border-slate-200/80 dark:border-slate-700/80 shadow-soft">
                <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-4">Tentang Penginapan Ini</h2>
                <p class="text-slate-600 dark:text-slate-300 leading-relaxed text-sm whitespace-pre-line">
                    {{ $property->description }}
                </p>
            </div>

            <!-- Facilities Card -->
            <div class="bg-white dark:bg-slate-800 rounded-3xl p-6 sm:p-8 border border-slate-200/80 dark:border-slate-700/80 shadow-soft">
                <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-6">Fasilitas Utama</h2>
                
                @if(!empty($property->facilities))
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                        @foreach($property->facilities as $facility)
                            <div class="flex items-center gap-3 p-3 rounded-2xl bg-slate-50 dark:bg-slate-900/60 border border-slate-100 dark:border-slate-700/50">
                                <div class="w-9 h-9 rounded-xl bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shrink-0">
                                    <i data-lucide="check-circle-2" class="w-5 h-5"></i>
                                </div>
                                <span class="text-xs font-semibold text-slate-800 dark:text-slate-200">{{ ucfirst($facility) }}</span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-sm text-slate-500 dark:text-slate-400">Informasi fasilitas belum ditambahkan.</p>
                @endif
            </div>

            <!-- Reviews Section -->
            <div class="bg-white dark:bg-slate-800 rounded-3xl p-6 sm:p-8 border border-slate-200/80 dark:border-slate-700/80 shadow-soft">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white">Ulasan Pengunjung</h2>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">Pendapat jujur dari tamu yang telah bermalam.</p>
                    </div>

                    <div class="flex items-center gap-2 bg-amber-50 dark:bg-amber-950/40 border border-amber-200 dark:border-amber-800/60 px-3.5 py-1.5 rounded-full text-amber-800 dark:text-amber-300 text-sm font-extrabold">
                        <i data-lucide="star" class="w-4 h-4 fill-amber-400 text-amber-400"></i>
                        <span>{{ $property->average_rating ?? 'Baru' }} / 5.0</span>
                    </div>
                </div>

                @if($property->reviews->isNotEmpty())
                    <div class="space-y-4">
                        @foreach($property->reviews as $review)
                            <div class="p-4 rounded-2xl bg-slate-50 dark:bg-slate-900/50 border border-slate-100 dark:border-slate-700/50">
                                <div class="flex items-center justify-between mb-2">
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-8 h-8 rounded-full bg-emerald-600 text-white font-bold text-xs flex items-center justify-center">
                                            {{ strtoupper(substr($review->user->name ?? 'G', 0, 1)) }}
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-xs text-slate-900 dark:text-white">{{ $review->user->name }}</h4>
                                            <span class="text-[10px] text-slate-400">Tamu Terverifikasi</span>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-1 bg-amber-100 dark:bg-amber-950 px-2 py-0.5 rounded-md text-amber-800 dark:text-amber-300 text-xs font-bold">
                                        <i data-lucide="star" class="w-3 h-3 fill-amber-400"></i>
                                        <span>{{ $review->rating }}/5</span>
                                    </div>
                                </div>
                                <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed pl-10">
                                    "{{ $review->comment }}"
                                </p>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-6 text-slate-500 dark:text-slate-400 text-sm">
                        Belum ada ulasan untuk penginapan ini.
                    </div>
                @endif
            </div>

        </div>

        <!-- Right Column: Sticky Floating Booking Widget -->
        <div class="lg:col-span-1">
            <div class="sticky top-28 bg-white dark:bg-slate-800 rounded-3xl p-6 sm:p-7 border border-slate-200/90 dark:border-slate-700 shadow-soft-lg">
                
                <!-- Price Header -->
                <div class="pb-5 mb-5 border-b border-slate-100 dark:border-slate-700 flex items-baseline justify-between">
                    <div>
                        <span class="text-xs text-slate-500 dark:text-slate-400">Harga per malam</span>
                        <div class="text-2xl font-extrabold text-emerald-600 dark:text-emerald-400">
                            Rp{{ number_format($property->price_per_night, 0, ',', '.') }}
                        </div>
                    </div>
                    <div class="text-xs text-slate-500 dark:text-slate-400 font-medium">
                        Termasuk Pajak
                    </div>
                </div>

                @auth
                    <!-- Booking Form -->
                    <form method="post" action="{{ route('bookings.store') }}" class="space-y-4">
                        @csrf
                        <input type="hidden" name="property_id" value="{{ $property->id }}">
                        
                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Tanggal Check-In</label>
                            <input type="date" name="check_in" required 
                                   class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-sm font-medium focus:ring-2 focus:ring-emerald-500 outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Tanggal Check-Out</label>
                            <input type="date" name="check_out" required 
                                   class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-sm font-medium focus:ring-2 focus:ring-emerald-500 outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Jumlah Tamu</label>
                            <input type="number" name="guest_count" min="1" max="{{ $property->capacity }}" value="1" required 
                                   class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-sm font-medium focus:ring-2 focus:ring-emerald-500 outline-none">
                            <span class="text-[11px] text-slate-400 mt-1 block">Maksimal {{ $property->capacity }} tamu</span>
                        </div>

                        <button type="submit" class="w-full py-3.5 rounded-2xl bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold text-sm shadow-md shadow-emerald-600/30 flex items-center justify-center gap-2 transition-all">
                            <i data-lucide="calendar-check" class="w-4 h-4"></i>
                            <span>Pesan Sekarang</span>
                        </button>
                    </form>
                @else
                    <div class="bg-slate-50 dark:bg-slate-900/60 p-5 rounded-2xl text-center border border-slate-100 dark:border-slate-700/50">
                        <i data-lucide="lock" class="w-8 h-8 text-slate-400 mx-auto mb-2"></i>
                        <p class="text-xs text-slate-600 dark:text-slate-300 mb-4 font-medium">Silakan masuk ke akun Anda untuk memesan penginapan ini.</p>
                        <a href="/login" class="block w-full py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs transition-all">
                            Masuk Ke Akun
                        </a>
                    </div>
                @endauth

            </div>
        </div>

    </div>
</x-layout>
