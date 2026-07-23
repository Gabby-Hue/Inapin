<x-layout>
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">Moderasi Review</h1>
        <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Daftar ulasan dari wisatawan untuk seluruh penginapan.</p>
    </div>

    @if($reviews->count() > 0)
        <div class="space-y-4 mb-10">
            @foreach($reviews as $review)
                <div class="bg-white dark:bg-slate-800 rounded-3xl p-6 border border-slate-200/80 dark:border-slate-700 shadow-soft flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <span class="px-2.5 py-0.5 rounded-md bg-amber-100 dark:bg-amber-950 text-amber-800 dark:text-amber-300 font-bold text-xs flex items-center gap-1">
                                <i data-lucide="star" class="w-3 h-3 fill-amber-400"></i>
                                <span>{{ $review->rating }}/5</span>
                            </span>
                            <span class="text-xs font-bold text-slate-900 dark:text-white">{{ $review->property->name }}</span>
                            <span class="text-xs text-slate-400">oleh {{ $review->user->name }}</span>
                        </div>
                        <p class="text-xs text-slate-600 dark:text-slate-300 mt-1">"{{ $review->comment }}"</p>
                    </div>

                    <form method="post" action="{{ route('admin.reviews.destroy', $review) }}" onsubmit="return confirm('Hapus review ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 rounded-xl bg-rose-50 dark:bg-rose-950/60 text-rose-600 dark:text-rose-400 hover:bg-rose-600 hover:text-white text-xs font-bold transition-all flex items-center gap-1.5">
                            <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                            <span>Hapus Review</span>
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white dark:bg-slate-800 rounded-3xl p-12 text-center border border-slate-200 dark:border-slate-700 shadow-soft">
            <i data-lucide="star-off" class="w-12 h-12 text-slate-400 mx-auto mb-3"></i>
            <h3 class="font-bold text-lg text-slate-800 dark:text-slate-200">Belum Ada Review</h3>
            <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Belum ada ulasan yang perlu dimoderasi saat ini.</p>
        </div>
    @endif
</x-layout>
