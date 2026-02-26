<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
         DB::statement("
            CREATE VIEW view_rekap_laporan AS
            SELECT 
                MONTH(tanggal_laporan) AS bulan,
                YEAR(tanggal_laporan) AS tahun,
                COUNT(*) AS jumlah_laporan_masuk,
                SUM(CASE WHEN status = 'diproses' THEN 1 ELSE 0 END) AS jumlah_diproses,
                SUM(CASE WHEN status = 'selesai' THEN 1 ELSE 0 END) AS jumlah_selesai,
                SUM(CASE WHEN status = 'ditolak' THEN 1 ELSE 0 END) AS jumlah_ditolak
            FROM tb_laporan
            GROUP BY YEAR(tanggal_laporan), MONTH(tanggal_laporan)
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('view_rekap_laporan');
    }
};
