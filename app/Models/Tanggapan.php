<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tanggapan extends Model
{
    use HasFactory;

    protected $table = 'tb_tanggapan';

    protected $fillable = [
        'laporan_id',
        'user_id',
        'isi_tanggapan',
        'tanggal_tanggapan',
    ];
    protected $casts = [
        'tanggal_tanggapan' => 'datetime',
    ];
    // Relasi: Tanggapan milik Laporan
    public function laporan()
    {
        return $this->belongsTo(Laporan::class, 'laporan_id');
    }

    // Relasi: Tanggapan dibuat oleh User (petugas)
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}