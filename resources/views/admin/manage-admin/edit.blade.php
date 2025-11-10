@extends('layouts.admin')
@section('title', 'Edit Admin - Dedikasi Malang')
@section('header')
    <div class="px-8 py-6">
        <h1 class="text-3xl font-bold text-gray-900">Edit Admin</h1>
        <p class="mt-1 text-sm text-gray-600">Perbarui detail untuk admin yang sudah ada.</p>
    </div>
@endsection

@section('content')
    @include('admin.manage-admin._form')
@endsection