<?php

namespace App\Http\Controllers;

use App\Http\Resources\LaporanResource;
use App\Http\Resources\LaporanDetailResource;
use App\Models\Laporan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    /**
     * Tampilkan semua laporan tanpa data pribadi pelapor
     */
    public function index()
    {
        // Ambil laporan beserta kategori
        $laporan = Laporan::with('kategori')->get();

        // Gunakan API Resource
        return LaporanResource::collection($laporan);
    }

    /**
     * Tampilkan laporan tertentu
     */
    public function show($id)
    {
        $laporan = Laporan::with([
            'kategori',
            'pelapor',
            'tanggapan.user'
        ])->findOrFail($id);

    return new LaporanDetailResource($laporan);
    }

    /**
     * Buat laporan baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategori_laporan,id',
            'pelapor_id' => 'required|exists:pelapor,id',
            'judul' => 'required|string|max:255',
            'isi_laporan' => 'required|string',
            'status' => 'required|in:diajukan,diproses,selesai,ditolak',
            'tanggal_laporan' => 'nullable|date',
        ]);

        $laporan = Laporan::create($validated);

        return new LaporanResource($laporan);
    }

    /**
     * Update laporan
     */
    public function update(Request $request, $id)
    {
        $laporan = Laporan::findOrFail($id);

        $validated = $request->validate([
            'kategori_id' => 'sometimes|exists:kategori_laporan,id',
            'judul' => 'sometimes|string|max:255',
            'isi_laporan' => 'sometimes|string',
            'status' => 'sometimes|in:diajukan,diproses,selesai,ditolak',
            'tanggal_laporan' => 'sometimes|date',
        ]);

        $laporan->update($validated);

        return new LaporanResource($laporan);
    }

    /**
     * Hapus laporan
     */
    public function destroy($id)
    {
        $laporan = Laporan::findOrFail($id);
        $laporan->delete();

        return response()->json(['message' => 'Laporan berhasil dihapus']);
    }
}