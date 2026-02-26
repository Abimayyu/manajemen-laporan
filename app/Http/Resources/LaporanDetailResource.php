<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Carbon\Carbon;

use Illuminate\Http\Resources\Json\JsonResource;

class LaporanDetailResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'judul' => $this->judul,
            'isi_laporan' => $this->isi_laporan,
            'kategori' => $this->kategori->nama_kategori,
            'status' => $this->status,
            'tanggal_laporan' => Carbon::parse($this->tanggal_laporan)->format('Y-m-d'),

            'tanggal_laporan' => $this->tanggal_laporan->format('Y-m-d'),

            'pelapor' => [
                'nama' => $this->pelapor->nama,
            ],

            'tanggapan' => $this->tanggapan->map(function($item) {
                return [
                    'isi_tanggapan' => $item->isi_tanggapan,
                    'tanggal_tanggapan' => Carbon::parse($this->tanggal_tanggapan)->format('Y-m-d'),
                    
                    'petugas' => [
                        'nama' => $item->user->name,
                    ],
                ];
            }),
        ];
    }
}