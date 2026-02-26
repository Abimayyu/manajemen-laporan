<?php

namespace App\Http\Controllers;

use App\Models\Tanggapan;
use App\Models\Laporan;
use App\Models\User;
use Illuminate\Http\Request;

class TanggapanController extends Controller
{
    public function index()
    {
        $tanggapan = Tanggapan::with(['laporan','user'])->get();
        return view('tanggapan.index', compact('tanggapan'));
    }

    public function create()
    {
        $laporan = Laporan::all();
        $petugas = User::where('role','petugas')->get();
        return view('tanggapan.create', compact('laporan','petugas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'laporan_id' => 'required|exists:tb_laporan,id',
            'user_id' => 'required|exists:users,id',
            'isi_tanggapan' => 'required|string',
            'tanggal_tanggapan' => 'nullable|date',
        ]);

        Tanggapan::create($validated);

        return redirect()->route('tanggapan.index')
            ->with('success', 'Tanggapan berhasil dibuat!');
    }

    public function show($id)
    {
        $tanggapan = Tanggapan::with(['laporan','user'])->findOrFail($id);
        return view('tanggapan.show', compact('tanggapan'));
    }

    public function edit($id)
    {
        $tanggapan = Tanggapan::findOrFail($id);
        $laporan = Laporan::all();
        $petugas = User::where('role','petugas')->get();
        return view('tanggapan.edit', compact('tanggapan','laporan','petugas'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'laporan_id' => 'required|exists:tb_laporan,id',
            'user_id' => 'required|exists:users,id',
            'isi_tanggapan' => 'required|string',
            'tanggal_tanggapan' => 'nullable|date',
        ]);

        $tanggapan = Tanggapan::findOrFail($id);
        $tanggapan->update($validated);

        return redirect()->route('tanggapan.index')
            ->with('success', 'Tanggapan berhasil diupdate!');
    }

    public function destroy($id)
    {
        $tanggapan = Tanggapan::findOrFail($id);
        $tanggapan->delete();

        return redirect()->route('tanggapan.index')
            ->with('success', 'Tanggapan berhasil dihapus!');
    }
}