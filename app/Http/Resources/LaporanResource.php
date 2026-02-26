<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class LaporanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
     public function toArray(Request $request): array
    {
        return [
            'judul' => $this->judul,
            'kategori' => $this->kategori->nama_kategori, // relasi ke kategori
            'tanggal_laporan' => Carbon::parse($this->tanggal_laporan)->format('Y-m-d'),
            'status' => $this->status,
        ];
    }
}
