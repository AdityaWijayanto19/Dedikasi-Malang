@extends('layouts.admin')
@section('title', 'Edit Pengurus - Dedikasi Malang')
@section('header')
    <div class="px-8 py-6">
        <h1 class="text-3xl font-bold text-gray-900">Edit Pengurus</h1>
        <p class="mt-1 text-sm text-gray-600">Perbarui detail untuk pengurus yang sudah ada.</p>
    </div>
@endsection

@section('content')
    @include('admin.pengurus._form')
@endsection