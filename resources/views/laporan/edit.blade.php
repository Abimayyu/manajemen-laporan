@extends('partials.main')
@section('title', 'Edit Laporan')
@section('lap-act', 'active')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Laporan</div>
                <div class="card-body">
                    <form action="{{ route('laporanweb.update', $laporan->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="judul">Judul Laporan</label>
                            <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul', $laporan->judul) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="kategori_id">Kategori</label>
                            <select name="kategori_id" id="kategori_id" class="form-control" required>
                                @foreach($kategori as $k)
                                    <option value="{{ $k->id }}" {{ old('kategori_id', $laporan->kategori_id) == $k->id ? 'selected' : '' }}>{{ $k->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="pelapor_id">Pelapor</label>
                            <select name="pelapor_id" id="pelapor_id" class="form-control" required>
                                @foreach($pelapor as $p)
                                    <option value="{{ $p->id }}" {{ old('pelapor_id', $laporan->pelapor_id) == $p->id ? 'selected' : '' }}>{{ $p->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="isi_laporan">Isi Laporan</label>
                            <textarea class="form-control" id="isi_laporan" name="isi_laporan" rows="4" required>{{ old('isi_laporan', $laporan->isi_laporan) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control" required>
                                @foreach(['diajukan','diproses','selesai','ditolak'] as $status)
                                    <option value="{{ $status }}" {{ old('status', $laporan->status) == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="tanggal_laporan">Tanggal Laporan</label>
                            <input type="date" class="form-control" id="tanggal_laporan" name="tanggal_laporan" value="{{ old('tanggal_laporan', $laporan->tanggal_laporan) }}">
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('laporanweb.index') }}" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection