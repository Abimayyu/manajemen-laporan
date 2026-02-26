<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\KategoriLaporan;
use App\Models\Pelapor;
use Illuminate\Http\Request;

class LaporanWevController extends Controller
{
    
    public function index()
    {
        // Eager loading kategori & pelapor
        $laporan = Laporan::with(['kategori','pelapor'])->get();

        return view('laporan.index', compact('laporan'));
    }

    /**
     * Form tambah laporan
     */
    public function create()
    {
        $kategori = KategoriLaporan::all();
        $pelapor = Pelapor::all();

        return view('laporan.create', compact('kategori','pelapor'));
    }

    /**
     * Simpan laporan baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori_id' => 'required|exists:tb_kategori_laporan,id',
            'pelapor_id' => 'required|exists:tb_pelapor,id',
            'judul' => 'required|string|max:255',
            'isi_laporan' => 'required|string',
            'status' => 'required|in:diajukan,diproses,selesai,ditolak',
            'tanggal_laporan' => 'nullable|date',
        ]);

        Laporan::create($validated);

        return redirect()->route('laporanweb.index')->with('success', 'Laporan berhasil ditambahkan');
    }

    /**
     * Form edit laporan
     */
    public function edit($id)
    {
        $laporan = Laporan::findOrFail($id);
        $kategori = KategoriLaporan::all();
        $pelapor = Pelapor::all();

        return view('laporan.edit', compact('laporan','kategori','pelapor'));
    }

    /**
     * Update laporan
     */
    public function update(Request $request, $id)
    {
        $laporan = Laporan::findOrFail($id);

        $validated = $request->validate([
            'kategori_id' => 'required|exists:tb_kategori_laporan,id',
            'pelapor_id' => 'required|exists:tb_pelapor,id',
            'judul' => 'required|string|max:255',
            'isi_laporan' => 'required|string',
            'status' => 'required|in:diajukan,diproses,selesai,ditolak',
            'tanggal_laporan' => 'nullable|date',
        ]);

        $laporan->update($validated);

        return redirect()->route('laporanweb.index')->with('success', 'Laporan berhasil diupdate');
    }

    /**
     * Hapus laporan
     */
    public function destroy($id)
    {
        $laporan = Laporan::findOrFail($id);
        $laporan->delete();

        return redirect()->route('laporanweb.index')->with('success', 'Laporan berhasil dihapus');
    }
}