<x-layout>
    <div class="mb-6">
        <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white">Tambah Properti Baru</h1>
        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Daftarkan tempat tinggal baru Anda untuk disetujui tim Inapin.</p>
    </div>
    @include('partner.properties.form', ['action' => route('partner.properties.store'), 'method' => 'POST', 'property' => null])
</x-layout>
