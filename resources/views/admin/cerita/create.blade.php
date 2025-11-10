@extends('layouts.admin')
@section('title', 'Tambah Cerita - Dedikasi Malang')
@section('header')
    <div class="px-8 py-6">
        <h1 class="text-3xl font-bold text-gray-900">Tambah Cerita Baru</h1>
        <p class="mt-1 text-sm text-gray-600">Buat dan bagikan cerita inspiratif kepada audiens Anda.</p>
    </div>
@endsection

@section('content')
    @include('admin.cerita._form')
@endsection