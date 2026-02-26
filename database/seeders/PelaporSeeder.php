<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PelaporSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        $namaPelapor = [
            'Ahmad Fauzi', 'Rina Sari', 'Budi Santoso', 'Siti Aminah', 'Dewi Lestari',
            'Andi Pratama', 'Citra Wulandari', 'Agus Setiawan', 'Indah Permata', 'Joko Susilo',
            'Rizki Maulana', 'Nina Marlina', 'Hendra Saputra', 'Lina Hartati', 'Fajar Nugroho',
            'Tina Puspita', 'Rudi Hartono', 'Maya Sari', 'Bayu Prasetyo', 'Fitri Ananda'
        ];

        $alamatPelapor = [
            'Jl. Merdeka No. 12, Jakarta', 'Jl. Sudirman No. 45, Bandung', 'Jl. Pahlawan No. 3, Surabaya',
            'Jl. Diponegoro No. 7, Semarang', 'Jl. Gatot Subroto No. 20, Yogyakarta', 'Jl. Malioboro No. 15, Yogyakarta',
            'Jl. Ahmad Yani No. 22, Medan', 'Jl. Pemuda No. 18, Bekasi', 'Jl. Sultan Agung No. 5, Bogor',
            'Jl. Hasanuddin No. 10, Makassar', 'Jl. Gajah Mada No. 2, Jakarta', 'Jl. Thamrin No. 30, Jakarta',
            'Jl. Raya No. 8, Depok', 'Jl. Cendrawasih No. 14, Palembang', 'Jl. Ciliwung No. 25, Jakarta',
            'Jl. Rawa Belong No. 9, Tangerang', 'Jl. Sisingamangaraja No. 11, Medan', 'Jl. Veteran No. 16, Surabaya',
            'Jl. Kenanga No. 3, Bandung', 'Jl. Melati No. 7, Jakarta'
        ];

        $pelapor = [];

        for ($i = 0; $i < 20; $i++) {
            $pelapor[] = [
                'nik' => '1771' . str_pad(rand(1000000000, 9999999999), 12, '0', STR_PAD_LEFT),
                'nama' => $namaPelapor[$i],
                'no_hp' => '0812' . rand(10000000, 99999999),
                'alamat' => $alamatPelapor[$i],
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        DB::table('tb_pelapor')->insert($pelapor);
    }
}





