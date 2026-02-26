@extends('partials.main')
@section('title', 'Data Tanggapan')
@section('tag-act', 'active')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Tanggapan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Data Tanggapan</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Tabel Data Tanggapan</h3>
                            @if (auth()->user()->role === 'admin')
                                <a href="{{ route('tanggapan.create') }}" class="btn btn-primary float-right">Tambah
                                    Tanggapan</a>
                            @endif
                        </div>
                        <div class="card-body">
                            <table id="tabel" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>Laporan</th>
                                        <th>Pelapor</th>
                                        <th>Petugas</th>
                                        <th>Isi Tanggapan</th>
                                        <th>Tanggal Tanggapan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach($tanggapan as $t)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $t->laporan->judul }}</td>
                                            <td>{{ $t->laporan->pelapor->nama }}</td>
                                            <td>{{ $t->user->name }}</td>
                                            <td>{{ $t->isi_tanggapan }}</td>
                                            <td>{{ $t->tanggal_tanggapan ? \Carbon\Carbon::parse($t->tanggal_tanggapan)->isoFormat('D MMMM Y') : '-' }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('tanggapan.edit', $t->id) }}" class="btn btn-success">
                                                        <i class="fas fa-edit" title="Edit Tanggapan"></i>
                                                    </a>
                                                    @if(auth()->user()->role === 'admin')
                                                        <form action="{{ route('tanggapan.destroy', $t->id) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger" title="Hapus Tanggapan">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>

    <!-- small modal -->
    <!-- small modal -->
    <div class="modal fade" id="smallModal" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" id="modalContent">
                <div class="modal-header">
                    <h5 class="modal-title" id="smallModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus data Tanggapan ini?
                </div>
                <div class="modal-footer">
                    <form action="" method="POST" id="deleteForm">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('customscript')
    <script>
        $(document).ready(function() {
            $('#tabel').DataTable({
                "paging": true, // Mengaktifkan paginasi
                "lengthChange": false, // Menonaktifkan pengaturan jumlah data per halaman
                "searching": true, // Mengaktifkan pencarian
                "ordering": true, // Mengaktifkan pengurutan
                "info": true, // Menampilkan informasi jumlah data
                "autoWidth": false, // Menonaktifkan pengaturan lebar otomatis
            });
        });
        $(document).ready(function() {
            $('#smallButton').click(function() {
                var url = $(this).data('attr');
                $('#deleteForm').attr('action', url);
            });
        });
    </script>
@endsection
