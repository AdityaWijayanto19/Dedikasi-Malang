@extends('layouts.admin')
@section('title', 'Tambah admin - Dedikasi Malang')
@section('header')
    <div class="px-8 py-6">
        <h1 class="text-3xl font-bold text-gray-900">Tambah admin</h1>
        <p class="mt-1 text-sm text-gray-600">Gunakan formulir ini untuk menambahkan admin baru ke dalam sistem.</p>
    </div>
@endsection

@section('content')
    @include('admin.manage-admin._form')
@endsection