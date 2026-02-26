<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RekapLaporan extends Model
{
    protected $table = 'view_rekap_laporan_bulanan'; // nama view
    public $timestamps = false; // view biasanya tidak punya created_at/updated_at
    protected $fillable = [
        'bulan', 'tahun', 'kategori', 'jumlah_masuk', 'jumlah_diproses', 'jumlah_selesai', 'jumlah_ditolak'
    ];
}