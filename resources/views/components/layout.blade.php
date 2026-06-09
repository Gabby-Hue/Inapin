<!doctype html>
<html lang="id">
<head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>{{ $title ?? 'Inapin' }}</title>@vite(['resources/css/app.css','resources/js/app.js'])</head>
<body class="bg-slate-50 text-slate-900">
<nav class="bg-white border-b"><div class="max-w-6xl mx-auto p-4 flex gap-4 items-center"><a class="font-bold text-xl text-emerald-700" href="/">Inapin</a><a href="/flights">Pesawat</a><a href="/ferries">Kapal</a><a href="/properties">Penginapan</a><span class="flex-1"></span>@auth<a href="/dashboard">Dashboard</a><form method="post" action="/logout">@csrf<button>Logout</button></form>@else<a href="/login">Login</a><a href="/register">Register</a>@endauth</div></nav>
<main class="max-w-6xl mx-auto p-6">@if(session('status'))<div class="mb-4 rounded bg-emerald-100 p-3">{{ session('status') }}</div>@endif @if($errors->any())<div class="mb-4 rounded bg-red-100 p-3"><ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif {{ $slot ?? '' }} @yield('content')</main>
</body></html>
