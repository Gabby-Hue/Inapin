<x-layout>
    <div class="mb-6">
        <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white">Edit Properti</h1>
        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Perbarui informasi, harga, atau fasilitas {{ $property->name }}.</p>
    </div>
    @include('partner.properties.form', ['action' => route('partner.properties.update', $property), 'method' => 'PUT'])
</x-layout>
