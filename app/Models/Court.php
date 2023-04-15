<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Court extends Model
{
    use HasFactory;

    protected $table = 'courts';

    protected $fillable = [
        'nama_lapangan',
        'alamat'
    ];

    /**
     * Get all of the comments for the DaftarLapangan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function order(): HasMany
    {
        return $this->hasMany(Order::class, 'lapangan_id', 'id');
    }
}
