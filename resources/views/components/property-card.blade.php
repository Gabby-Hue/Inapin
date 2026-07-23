@props(['property'])

@php
    // Curated high quality travel imagery for fallbacks based on category/id
    $fallbackImages = [
        'Villa' => 'https://images.unsplash.com/photo-1580587771525-78b9dba3b914?auto=format&fit=crop&w=800&q=80',
        'Resort' => 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=800&q=80',
        'Homestay' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=800&q=80',
        'Guest House' => 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?auto=format&fit=crop&w=800&q=80',
        'Cottage' => 'https://images.unsplash.com/photo-1470770841072-f978cf4d019e?auto=format&fit=crop&w=800&q=80',
        'Glamping' => 'https://images.unsplash.com/photo-1510312305653-8ed496efae75?auto=format&fit=crop&w=800&q=80',
    ];

    $imageSrc = $property->images && $property->images->first() 
        ? asset('storage/' . $property->images->first()->image_path)
        : ($fallbackImages[$property->category] ?? 'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=800&q=80');
@endphp

<div class="group bg-white dark:bg-slate-800 rounded-2xl overflow-hidden border border-slate-200/80 dark:border-slate-700/80 shadow-soft hover:shadow-soft-lg transition-all duration-300 flex flex-col justify-between">
    <div>
        <!-- Image & Badges Overlay -->
        <div class="relative aspect-4/3 overflow-hidden bg-slate-100 dark:bg-slate-700">
            <img src="{{ $imageSrc }}" 
                 alt="{{ $property->name }}" 
                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                 loading="lazy">
            
            <!-- Category Badge -->
            <div class="absolute top-3 left-3 bg-slate-900/70 backdrop-blur-md text-white text-xs font-semibold px-3 py-1 rounded-full shadow-sm">
                {{ $property->category }}
            </div>

            <!-- Average Rating Badge -->
            <div class="absolute top-3 right-3 bg-white/90 dark:bg-slate-900/90 backdrop-blur-md text-slate-800 dark:text-slate-100 text-xs font-bold px-2.5 py-1 rounded-full shadow-sm flex items-center gap-1">
                <i data-lucide="star" class="w-3.5 h-3.5 fill-amber-400 text-amber-400"></i>
                <span>{{ $property->average_rating ?? 'Baru' }}</span>
            </div>
        </div>

        <!-- Card Content -->
        <div class="p-5">
            <!-- Location -->
            <div class="flex items-center gap-1 text-slate-500 dark:text-slate-400 text-xs font-medium mb-1.5">
                <i data-lucide="map-pin" class="w-3.5 h-3.5 text-emerald-600 dark:text-emerald-400"></i>
                <span>{{ $property->city }}</span>
            </div>

            <!-- Title -->
            <h3 class="font-bold text-slate-900 dark:text-white text-base group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors line-clamp-1">
                <a href="{{ route('properties.show', $property) }}">
                    {{ $property->name }}
                </a>
            </h3>

            <!-- Facilities snippet if available -->
            @if(!empty($property->facilities))
                <div class="mt-2.5 flex flex-wrap gap-1.5">
                    @foreach(array_slice($property->facilities, 0, 3) as $facility)
                        <span class="text-[11px] px-2 py-0.5 rounded-md bg-slate-100 dark:bg-slate-700/60 text-slate-600 dark:text-slate-300 font-medium">
                            {{ ucfirst($facility) }}
                        </span>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <!-- Footer Action & Price -->
    <div class="px-5 pb-5 pt-3 border-t border-slate-100 dark:border-slate-700/50 flex items-center justify-between">
        <div>
            <span class="text-xs text-slate-500 dark:text-slate-400">Mulai dari</span>
            <div class="text-emerald-600 dark:text-emerald-400 font-extrabold text-base">
                Rp{{ number_format($property->price_per_night, 0, ',', '.') }}
                <span class="text-xs font-normal text-slate-500 dark:text-slate-400">/malam</span>
            </div>
        </div>

        <a href="{{ route('properties.show', $property) }}" 
           class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-slate-100 hover:bg-emerald-600 hover:text-white dark:bg-slate-700 dark:hover:bg-emerald-500 text-slate-700 dark:text-slate-200 text-xs font-bold transition-all duration-200">
            <span>Detail</span>
            <i data-lucide="chevron-right" class="w-4 h-4"></i>
        </a>
    </div>
</div>
