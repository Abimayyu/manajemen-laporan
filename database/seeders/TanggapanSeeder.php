<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TanggapanSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        $laporanData = DB::table('laporan')
            ->join('kategori_laporan', 'laporan.kategori_id', '=', 'kategori_laporan.id')
            ->select('laporan.id as laporan_id', 'kategori_laporan.nama_kategori')
            ->get();

        $petugasIds = DB::table('users')->where('role', 'petugas')->pluck('id')->toArray();

        $tanggapan = [];

        // Template tanggapan per kategori
        $templates = [
            'Infrastruktur' => [
                'Akan segera diperbaiki sesuai prosedur teknis.',
                'Tim teknis akan meninjau lokasi dan melakukan perbaikan.',
                'Mohon bersabar, perbaikan dijadwalkan minggu ini.'
            ],
            'Lingkungan' => [
                'Petugas kebersihan akan menindaklanjuti laporan ini.',
                'Tim lingkungan akan segera membersihkan lokasi.',
                'Terima kasih atas laporannya, tindakan akan segera dilakukan.'
            ],
            'Kesehatan & Kebersihan' => [
                'Tim kesehatan akan memeriksa lokasi dan melakukan tindakan pencegahan.',
                'Segera dilakukan koordinasi dengan dinas terkait.',
                'Terima kasih, kami akan menangani masalah ini secepatnya.'
            ],
            'Keamanan & Ketertiban' => [
                'Tim keamanan setempat akan menindaklanjuti laporan ini.',
                'Segera dilakukan patroli dan tindakan preventif.',
                'Terima kasih, tindakan akan segera dilakukan oleh pihak berwenang.'
            ],
            'Layanan Publik' => [
                'Pihak terkait akan segera memperbaiki fasilitas publik.',
                'Segera dijadwalkan perbaikan dan pemeliharaan fasilitas.',
                'Terima kasih, laporan akan ditindaklanjuti segera.'
            ]
        ];

        // Buat 30 tanggapan realistis
        for ($i = 1; $i <= 30; $i++) {
            $laporan = $laporanData->random(); // pilih laporan acak

            $kategori = $laporan->nama_kategori;
            $isiOptions = $templates[$kategori];

            $tanggapan[] = [
                'laporan_id' => $laporan->laporan_id,
                'user_id' => $petugasIds[array_rand($petugasIds)],
                'isi_tanggapan' => $isiOptions[array_rand($isiOptions)],
                'tanggal_tanggapan' => $now->copy()->subDays(rand(0, 60)),
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        DB::table('tanggapan')->insert($tanggapan);
    }
}