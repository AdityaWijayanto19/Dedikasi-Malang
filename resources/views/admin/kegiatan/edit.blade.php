@extends('layouts.admin')
@section('title', 'Edit Kegiatan - Dedikasi Malang')
@section('header')
    <div class="px-8 py-6">
        <h1 class="text-3xl font-bold text-gray-900">Edit Kegiatan</h1>
        <p class="mt-1 text-sm text-gray-600">Perbarui detail untuk kegiatan yang sudah ada.</p>
    </div>
@endsection

@section('content')
    @include('admin.kegiatan._form')
@endsection