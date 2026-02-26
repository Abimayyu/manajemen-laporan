<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $now = now();

        $kategori = [
            ['nama_kategori' => 'Infrastruktur', 'deskripsi' => 'Masalah jalan, jembatan, dan fasilitas umum', 'created_at' => $now, 'updated_at' => $now],
            ['nama_kategori' => 'Lingkungan', 'deskripsi' => 'Masalah sampah, banjir, saluran air', 'created_at' => $now, 'updated_at' => $now],
            ['nama_kategori' => 'Kesehatan & Kebersihan', 'deskripsi' => 'Sanitasi, limbah, polusi', 'created_at' => $now, 'updated_at' => $now],
            ['nama_kategori' => 'Keamanan & Ketertiban', 'deskripsi' => 'Bangunan liar, kriminalitas, bencana', 'created_at' => $now, 'updated_at' => $now],
            ['nama_kategori' => 'Layanan Publik', 'deskripsi' => 'Lampu jalan mati, transportasi, air bersih', 'created_at' => $now, 'updated_at' => $now],
        ];

        DB::table('tb_kategori_laporan')->insert($kategori);
    }
}
