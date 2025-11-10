@extends('layouts.admin')
@section('title', 'Edit Cerita - Dedikasi Malang')
@section('header')
    <div class="px-8 py-6">
        <h1 class="text-3xl font-bold text-gray-900">Edit Cerita</h1>
        <p class="mt-1 text-sm text-gray-600">Perbarui konten cerita yang sudah ada di bawah ini.</p>
    </div>
@endsection

@section('content')
    @include('admin.cerita._form')
@endsection