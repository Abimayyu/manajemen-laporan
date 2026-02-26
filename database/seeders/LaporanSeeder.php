<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LaporanSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        $pelaporIds = DB::table('tb_pelapor')->pluck('id')->toArray();
        $kategoriData = DB::table('tb_kategori_laporan')->get();

        $statusList = ['diajukan', 'diproses', 'selesai', 'ditolak'];

        $laporan = [];

        $templates = [
            'Infrastruktur' => [
                ['judul' => 'Jalan Rusak di lingkungan RT 05', 'isi' => 'Jalan utama di RT 05 berlubang dan membahayakan kendaraan. Memerlukan perbaikan segera.'],
                ['judul' => 'Jembatan kecil retak', 'isi' => 'Jembatan di kampung kami mengalami retak dan rawan roboh, perlu tindakan cepat.']
            ],
            'Lingkungan' => [
                ['judul' => 'Sampah menumpuk di selokan', 'isi' => 'Selokan di depan rumah menumpuk sampah dan mengganggu aliran air.'],
                ['judul' => 'Banjir kecil saat hujan', 'isi' => 'Lingkungan RT 03 tergenang saat hujan karena saluran air tersumbat.']
            ],
            'Kesehatan & Kebersihan' => [
                ['judul' => 'Limbah pabrik mencemari sungai', 'isi' => 'Sungai di kampung kami tercemar limbah pabrik, bau menyengat dan berbahaya.'],
                ['judul' => 'Polusi udara dari kendaraan', 'isi' => 'Kendaraan bermotor menimbulkan polusi udara tinggi di jalan utama.']
            ],
            'Keamanan & Ketertiban' => [
                ['judul' => 'Bangunan liar di pinggir jalan', 'isi' => 'Bangunan liar mengganggu keamanan dan kenyamanan warga.'],
                ['judul' => 'Kejahatan di malam hari meningkat', 'isi' => 'Warga merasa tidak aman karena sering terjadi pencurian di malam hari.']
            ],
            'Layanan Publik' => [
                ['judul' => 'Lampu jalan mati di RT 08', 'isi' => 'Lampu jalan di RT 08 mati selama 2 minggu, rawan kecelakaan.'],
                ['judul' => 'Air bersih tidak lancar', 'isi' => 'Pasokan air bersih di RT 02 sering macet, mengganggu aktivitas warga.']
            ]
        ];

        for ($i = 1; $i <= 50; $i++) {

            $kategori = $kategoriData->random();
            $templateArray = $templates[$kategori->nama_kategori];

            $selectedTemplate = $templateArray[array_rand($templateArray)];

            $laporan[] = [
                'kategori_id' => $kategori->id,
                'pelapor_id' => $pelaporIds[array_rand($pelaporIds)],
                'judul' => $selectedTemplate['judul'],
                'isi_laporan' => $selectedTemplate['isi'],
                'status' => $statusList[array_rand($statusList)],
                'tanggal_laporan' => $now->copy()->subDays(rand(0, 120)),
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        DB::table('tb_laporan')->insert($laporan);
    }
}