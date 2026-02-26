<?php

namespace App\Http\Controllers;

use App\Models\RekapLaporan;
use App\Models\KategoriLaporan;
use Illuminate\Http\Request;

class RekapLaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = RekapLaporan::query();

        // Filter Bulan
        if ($request->filled('bulan')) {
            $query->where('bulan', $request->bulan);
        }

        // Filter Tahun
        if ($request->filled('tahun')) {
            $query->where('tahun', $request->tahun);
        }

        // Filter Kategori
        if ($request->filled('kategori_id')) {
            $kategori = KategoriLaporan::find($request->kategori_id);
            if($kategori) {
                $query->where('kategori', $kategori->nama_kategori);
            }
        }

        $rekap = $query->orderBy('tahun','desc')->orderBy('bulan','desc')->get();
        $kategoriList = KategoriLaporan::all();

        return view('rekap-laporan.index', compact('rekap','kategoriList'));
    }
}