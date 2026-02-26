<?php

namespace App\Http\Controllers;

use App\Models\KategoriLaporan;
use App\Models\Laporan;
use App\Models\Tanggapan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if($user->role === 'admin') {
            $kategoriCount = KategoriLaporan::count();
            $laporanCount = Laporan::count();
            $laporanDiajukan = Laporan::where('status','diajukan')->count();
            $laporanDiproses = Laporan::where('status','diproses')->count();
            $laporanSelesai = Laporan::where('status','selesai')->count();
            $laporanDitolak = Laporan::where('status','ditolak')->count();
            $tanggapanCount = Tanggapan::count();

            return view('dashboard', compact(
                'kategoriCount',
                'laporanCount',
                'laporanDiajukan',
                'laporanDiproses',
                'laporanSelesai',
                'laporanDitolak',
                'tanggapanCount'
            ));

        } elseif($user->role === 'petugas') {
            // Petugas hanya lihat tanggapan mereka
            $tanggapanCount = Tanggapan::where('user_id', $user->id)->count();
            $tanggapanPending = Tanggapan::where('user_id', $user->id)
                                         ->whereHas('laporan', fn($q) => $q->where('status','diajukan'))
                                         ->count();

            return view('dashboard.index', compact('tanggapanCount','tanggapanPending'));
        }
    }
}