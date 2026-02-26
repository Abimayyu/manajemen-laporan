@extends('partials.main')
@section('title', 'Tambah Tanggapan')
@section('tag-act', 'active')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tambah Tanggapan</div>
                <div class="card-body">
                    <form action="{{ route('tanggapan.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="laporan_id">Laporan</label>
                            <select name="laporan_id" id="laporan_id" class="form-control" required>
                                <option value="">-- Pilih Laporan --</option>
                                @foreach($laporan as $l)
                                    <option value="{{ $l->id }}" {{ old('laporan_id') == $l->id ? 'selected' : '' }}>
                                        {{ $l->judul }} ({{ $l->pelapor->nama }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="user_id">Petugas</label>
                            <select name="user_id" id="user_id" class="form-control" required>
                                <option value="">-- Pilih Petugas --</option>
                                @foreach($petugas as $u)
                                    <option value="{{ $u->id }}" {{ old('user_id') == $u->id ? 'selected' : '' }}>
                                        {{ $u->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="isi_tanggapan">Isi Tanggapan</label>
                            <textarea name="isi_tanggapan" id="isi_tanggapan" rows="4" class="form-control" required>{{ old('isi_tanggapan') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="tanggal_tanggapan">Tanggal Tanggapan</label>
                            <input type="date" class="form-control" id="tanggal_tanggapan" name="tanggal_tanggapan" value="{{ old('tanggal_tanggapan', date('Y-m-d')) }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('tanggapan.index') }}" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection