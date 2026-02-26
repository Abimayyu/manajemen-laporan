<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelapor extends Model
{
    use HasFactory;

    protected $table = 'tb_pelapor';

    protected $fillable = [
        'nik',
        'nama',
        'no_hp',
        'alamat',
    ];

    // Relasi: 1 pelapor punya banyak laporan
    public function laporan()
    {
        return $this->hasMany(Laporan::class, 'pelapor_id');
    }
}