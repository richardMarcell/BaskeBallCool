<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JoinResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id_join' => $this->id,
            'nama_pemain' => $this->nama_pemain,
            'pemesan' => $this->pemesan,
            'posisi' => $this->posisi,
            'pesan' => $this->pesan,
            'status_id' => $this->status_id,
        ];
    }
}
