<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $table = 'tb_laporan';

    protected $fillable = [
        'kategori_id',
        'pelapor_id',
        'judul',
        'isi_laporan',
        'status',
        'tanggal_laporan',
    ];
    protected $casts = [
        'tanggal_laporan' => 'datetime',
    ];


    // Relasi: Laporan milik Pelapor
    public function pelapor()
    {
        return $this->belongsTo(Pelapor::class, 'pelapor_id');
    }

    // Relasi: Laporan milik Kategori
    public function kategori()
    {
        return $this->belongsTo(KategoriLaporan::class, 'kategori_id');
    }

    // Relasi: Laporan punya banyak Tanggapan
    public function tanggapan()
    {
        return $this->hasMany(Tanggapan::class, 'laporan_id');
    }
}