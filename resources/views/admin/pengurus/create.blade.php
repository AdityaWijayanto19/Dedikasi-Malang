@extends('layouts.admin')
@section('title', 'Tambah Pengurus - Dedikasi Malang')
@section('header')
    <div class="px-8 py-6">
        <h1 class="text-3xl font-bold text-gray-900">Tambah Pengurus</h1>
        <p class="mt-1 text-sm text-gray-600">Gunakan formulir ini untuk menambahkan pengurus baru ke dalam sistem.</p>
    </div>
@endsection

@section('content')
    @include('admin.pengurus._form')
@endsection