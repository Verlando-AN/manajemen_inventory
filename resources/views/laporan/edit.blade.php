@extends('layout.main')

@section('container')
<div class="container mt-5">
    <link rel="stylesheet" href="{{ asset('css/barang.css') }}">
    <!-- Header -->
    <header class="mb-4 d-flex justify-content-between align-items-center">
        <h1 class="heading">Detail Laporan Kerusakan</h1>
        <a href="{{ route('laporan.index') }}" class="btn btn-secondary btn-lg">Kembali</a>
    </header>

    <!-- Card for Product Detail -->
    <div class="card shadow border-0 rounded">
        <div class="card-body">
            <div class="row">
                <!-- Main Image Column -->
                <div class="col-md-3 mb-4">
                    @if($laporan->fotoKerusakans->count())
                        <div class="position-relative">
                            <img src="{{ asset('storage/' . $laporan->fotoKerusakans->first()->path) }}" class="img-fluid rounded-top" style="height: 300px; object-fit: cover;" alt="Foto Kerusakan"/>
                            <div class="position-absolute top-0 start-0 p-3 bg-dark bg-opacity-50 text-white rounded-end">
                                <h5 class="card-title fs-4 mb-1">{{ $laporan->nama_laptop }}</h5>
                                <p class="card-text mb-0">{{ ucfirst($laporan->jenis_kerusakan) }}</p>
                            </div>
                        </div>
                    @else
                        <p class="text-center text-muted">Tidak ada foto kerusakan tersedia.</p>
                    @endif
                </div>

                <!-- Detail and Form Column -->
                <div class="col-md-6">
                    <!-- Detail Laporan -->
                    <div class="mb-3    md-3">
                        <h5 class="text-primary">Detail Laporan</h5>
                        <dl class="row">
                            <dt class="col-sm-4 text-muted">Nama Laptop:</dt>
                            <dd class="col-sm-8">{{ $laporan->nama_laptop }}</dd>
                            <dt class="col-sm-4 text-muted">Barcode:</dt>
                            <dd class="col-sm-8">{{ $laporan->barcode }}</dd>
                            <dt class="col-sm-4 text-muted">Jenis Kerusakan:</dt>
                            <dd class="col-sm-8">{{ ucfirst($laporan->jenis_kerusakan) }}</dd>
                            <dt class="col-sm-4 text-muted">Deskripsi:</dt>
                            <dd class="col-sm-8">{{ $laporan->deskripsi }}</dd>
                        </dl>
                    </div>

                    <!-- Form Column -->
                    
                </div>
                <form action="{{ route('laporan.update', $laporan->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="status_id" class="form-label">Status</label>
                        <select name="status_id" id="status_id" class="form-select" required>
                            @foreach($statuss as $status)
                                <option value="{{ $status->id }}" {{ $status->id == $laporan->status_id ? 'selected' : '' }}>
                                    {{ $status->status }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-2">
                        <label for="estimasi_selesai" class="form-label">Estimasi Selesai</label>
                        <input type="date" name="estimasi_selesai" id="estimasi_selesai" class="form-control" 
                               value="{{ old('estimasi_selesai', $laporan->estimasi_selesai ? \Carbon\Carbon::parse($laporan->estimasi_selesai)->format('d-m-y') : '') }}">
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-lg">Perbarui Status</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
