<x-layout><h1 class="text-2xl font-bold mb-4">Edit Properti</h1>@include('partner.properties.form', ['action'=>route('partner.properties.update',$property), 'method'=>'PUT'])</x-layout>
