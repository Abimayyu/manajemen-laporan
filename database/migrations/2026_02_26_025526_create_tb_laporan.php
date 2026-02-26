<?php

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
        Schema::create('tb_laporan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')
                ->constrained('tb_kategori_laporan')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('pelapor_id')
                ->constrained('tb_pelapor')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->string('judul', 200);
            $table->text('isi_laporan');

            $table->enum('status', [
                'diajukan',
                'diproses',
                'selesai',
                'ditolak'
            ])->default('diajukan')->index();

            $table->dateTime('tanggal_laporan')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_laporan');
    }
};
