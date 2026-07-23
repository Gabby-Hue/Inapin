<form method="post" action="{{ $action }}" enctype="multipart/form-data" class="bg-white dark:bg-slate-800 rounded-3xl p-6 sm:p-8 border border-slate-200/80 dark:border-slate-700 shadow-soft space-y-4">
    @csrf
    @if($method !== 'POST')
        @method($method)
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Nama Properti</label>
            <input name="name" value="{{ old('name', $property?->name) }}" required placeholder="Contoh: Villa Ubud Sunset"
                   class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-sm font-medium focus:ring-2 focus:ring-emerald-500 outline-none">
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Kategori</label>
            <select name="category" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-sm font-medium focus:ring-2 focus:ring-emerald-500 outline-none">
                @foreach($categories as $category)
                    <option value="{{ $category }}" @selected(old('category', $property?->category) === $category)>{{ $category }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div>
        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Deskripsi Lengkap</label>
        <textarea name="description" rows="3" placeholder="Jelaskan kenyamanan dan keunggulan tempat menginap..." required
                  class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-sm font-medium focus:ring-2 focus:ring-emerald-500 outline-none">{{ old('description', $property?->description) }}</textarea>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Kota Destinasi</label>
            <input name="city" value="{{ old('city', $property?->city) }}" required placeholder="Contoh: Bali, Yogyakarta"
                   class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-sm font-medium focus:ring-2 focus:ring-emerald-500 outline-none">
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Alamat Lengkap</label>
            <input name="address" value="{{ old('address', $property?->address) }}" required placeholder="Jalan, Desa, Kecamatan..."
                   class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-sm font-medium focus:ring-2 focus:ring-emerald-500 outline-none">
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Harga Per Malam (Rp)</label>
            <input name="price_per_night" type="number" value="{{ old('price_per_night', $property?->price_per_night) }}" required placeholder="750000"
                   class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-sm font-medium focus:ring-2 focus:ring-emerald-500 outline-none">
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Kapasitas Maksimal Tamu</label>
            <input name="capacity" type="number" value="{{ old('capacity', $property?->capacity) }}" required placeholder="4"
                   class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-sm font-medium focus:ring-2 focus:ring-emerald-500 outline-none">
        </div>
    </div>

    <div>
        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Fasilitas (Pisahkan Dengan Koma)</label>
        <input name="facilities" value="{{ old('facilities', implode(', ', $property?->facilities ?? [])) }}" placeholder="wifi, pool, ac, parking, breakfast"
               class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-sm font-medium focus:ring-2 focus:ring-emerald-500 outline-none">
        <span class="text-[11px] text-slate-400 mt-1 block">Contoh: WiFi, Kolam Renang, AC, Dapur, Parkir Gratis</span>
    </div>

    <div>
        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Upload Foto Properti (Bisa Banyak Foto)</label>
        <input type="file" name="images[]" multiple class="w-full px-4 py-2 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-emerald-600 file:text-white hover:file:bg-emerald-700 cursor-pointer">
    </div>

    <div class="pt-4 border-t border-slate-100 dark:border-slate-700 flex justify-end gap-3">
        <a href="{{ route('partner.properties.index') }}" class="px-5 py-2.5 rounded-xl bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-200 font-bold text-xs">
            Batal
        </a>
        <button type="submit" class="px-6 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold text-xs shadow-md shadow-emerald-600/30">
            Simpan Properti
        </button>
    </div>
</form>
