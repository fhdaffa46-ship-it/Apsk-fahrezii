@extends('layouts.admin')

@section('title', 'Laporan Aspirasi')

@section('content')
    <h4 class="mb-4 mt-3">Laporan Aspirasi</h4>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        <!-- Detail laporan -->
        <div class="col-md-8">
            @include('admin.laporan.detil')
        </div>
        <!-- Form update status -->
        <div class="col-md-4">
            @include('admin.laporan.form-status')
        </div>
    </div>
@endsection