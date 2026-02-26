@extends('partials.main')
@section('title','Rekap Laporan')
@section('content')

<div class="container">
    <h1 class="mb-4">Rekap Laporan Bulanan</h1>

    {{-- Filter --}}
    <form method="GET" action="{{ route('rekap-laporan.index') }}" class="form-inline mb-3">
        <div class="form-group mr-2">
            <label for="bulan">Bulan:</label>
            <select name="bulan" id="bulan" class="form-control ml-2">
                <option value="">-- Semua Bulan --</option>
                @for($m=1;$m<=12;$m++)
                    <option value="{{ $m }}" {{ request('bulan')==$m?'selected':'' }}>
                        {{ \Carbon\Carbon::create()->month($m)->isoFormat('MMMM') }}
                    </option>
                @endfor
            </select>
        </div>

        <div class="form-group mr-2">
            <label for="tahun">Tahun:</label>
            <input type="number" name="tahun" id="tahun" class="form-control ml-2" value="{{ request('tahun') }}" placeholder="YYYY">
        </div>

        <div class="form-group mr-2">
            <label for="kategori_id">Kategori:</label>
            <select name="kategori_id" id="kategori_id" class="form-control ml-2">
                <option value="">-- Semua Kategori --</option>
                @foreach($kategoriList as $k)
                    <option value="{{ $k->id }}" {{ request('kategori_id')==$k->id?'selected':'' }}>
                        {{ $k->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Filter</button>
    </form>

    {{-- Tabel Rekap --}}
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Bulan</th>
                <th>Tahun</th>
                <th>Kategori</th>
                <th>Jumlah Masuk</th>
                <th>Jumlah Diproses</th>
                <th>Jumlah Selesai</th>
                <th>Jumlah Ditolak</th>
            </tr>
        </thead>
        <tbody>
            @forelse($rekap as $r)
                <tr>
                    <td>{{ \Carbon\Carbon::create()->month($r->bulan)->isoFormat('MMMM') }}</td>
                    <td>{{ $r->tahun }}</td>
                    <td>{{ $r->kategori }}</td>
                    <td>{{ $r->jumlah_masuk }}</td>
                    <td>{{ $r->jumlah_diproses }}</td>
                    <td>{{ $r->jumlah_selesai }}</td>
                    <td>{{ $r->jumlah_ditolak }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Data tidak ditemukan</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection