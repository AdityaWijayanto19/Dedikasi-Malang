@extends('layouts.admin')
@section('title', 'Edit Donasi - Dedikasi Malang')
@section('header')
    <div class="px-8 py-6">
        <h1 class="text-3xl font-bold text-gray-900">Edit Donasi</h1>
        <p class="mt-1 text-sm text-gray-600">Perbarui detail untuk donasi yang sudah ada.</p>
    </div>
@endsection

@section('content')
    @include('admin.donasi._form')
@endsection