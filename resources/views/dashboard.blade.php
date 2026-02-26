@extends('partials.main')
@section('title','Dashboard')

@section('content')
<div class="container">
    <h1 class="mb-4">Dashboard</h1>

    @if(auth()->user()->role === 'admin')
    <div class="row">
        {{-- Kategori --}}
        <div class="col-md-3 mb-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Kategori</h5>
                    <p class="card-text">{{ $kategoriCount }} Kategori</p>
                    <a href="{{ route('kategori.index') }}" class="btn btn-primary">Kelola</a>
                </div>
            </div>
        </div>

        {{-- Laporan --}}
        <div class="col-md-3 mb-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Laporan</h5>
                    <p class="card-text">Total: {{ $laporanCount }}</p>
                    <p class="card-text">Diajukan: {{ $laporanDiajukan }} | Diproses: {{ $laporanDiproses }}</p>
                    <p class="card-text">Selesai: {{ $laporanSelesai }} | Ditolak: {{ $laporanDitolak }}</p>
                    <a href="{{ route('laporanweb.index') }}" class="btn btn-primary">Kelola</a>
                </div>
            </div>
        </div>

        {{-- Tanggapan --}}
        <div class="col-md-3 mb-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Tanggapan</h5>
                    <p class="card-text">{{ $tanggapanCount }} Tanggapan</p>
                    <a href="{{ route('tanggapan.index') }}" class="btn btn-primary">Kelola</a>
                </div>
            </div>
        </div>
    </div>

    @elseif(auth()->user()->role === 'petugas')
    <div class="row">
        {{-- Tanggapan --}}
        <div class="col-md-4 mb-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Tanggapan Anda</h5>
                    <p class="card-text">Total Tanggapan: {{ $tanggapanCount }}</p>
                    <p class="card-text">Tanggapan pada laporan diajukan: {{ $tanggapanPending }}</p>
                    <a href="{{ route('tanggapan.index') }}" class="btn btn-primary">Kelola</a>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection