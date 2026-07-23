@props(['status'])

@php
    $styles = [
        'confirmed' => 'bg-emerald-100 text-emerald-800 dark:bg-emerald-950/80 dark:text-emerald-300 border-emerald-200 dark:border-emerald-800',
        'approved'  => 'bg-emerald-100 text-emerald-800 dark:bg-emerald-950/80 dark:text-emerald-300 border-emerald-200 dark:border-emerald-800',
        'pending'   => 'bg-amber-100 text-amber-800 dark:bg-amber-950/80 dark:text-amber-300 border-amber-200 dark:border-amber-800',
        'completed' => 'bg-blue-100 text-blue-800 dark:bg-blue-950/80 dark:text-blue-300 border-blue-200 dark:border-blue-800',
        'cancelled' => 'bg-rose-100 text-rose-800 dark:bg-rose-950/80 dark:text-rose-300 border-rose-200 dark:border-rose-800',
        'rejected'  => 'bg-rose-100 text-rose-800 dark:bg-rose-950/80 dark:text-rose-300 border-rose-200 dark:border-rose-800',
    ];

    $badgeStyle = $styles[strtolower($status)] ?? 'bg-slate-100 text-slate-800 dark:bg-slate-800 dark:text-slate-200 border-slate-200';
@endphp

<span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold border {{ $badgeStyle }}">
    <span class="w-1.5 h-1.5 rounded-full bg-current"></span>
    <span>{{ ucfirst($status) }}</span>
</span>
