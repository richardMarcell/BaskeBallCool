<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id_pesanan' => $this->id,
            'pemesan' => $this->pemesan,
            'email' => $this->email,
            'tanggal' => $this->tanggal,
            'waktu' => $this->waktu_mulai. 's/d' . $this->waktu_selesai,
            'jumlah_pemain' => $this->jumlah_pemain,
            'jumlah_pemain_max' => $this->jumlah_pemain_max,
            'status' => $this->status,
            'status_izin' => $this->status_izin,
            'lapangan_id' => $this->lapangan_id,
            'status_selesai_id' => $this->status_selesai_id,
        ];
    }
}
