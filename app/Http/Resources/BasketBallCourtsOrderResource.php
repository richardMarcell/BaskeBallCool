<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BasketBallCourtsOrderResource extends JsonResource
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
            'lapangan_id' => $this->lapangan_id,
            'jam' => $this->waktu_mulai . ' s/d ' . $this -> waktu_selesai,
            'tanggal' => $this->tanggal,
            'pemesan' => $this->pemesan,
        ];
    }
}
