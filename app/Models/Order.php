<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';

    /**
     * Get the user that owns the DaftarPesanan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function court(): BelongsTo   
    {
        return $this->belongsTo(Court::class, 'lapangan_id', 'id');
    }

    public function status_selesai(): BelongsTo
    {
        return $this->belongsTo(PlayingStatus::class, 'status_selesai_id');
    }
}
