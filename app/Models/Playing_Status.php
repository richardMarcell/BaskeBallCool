<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PlayingStatus extends Model
{
    use HasFactory;
    protected $table = 'playing_status';


    /**
     * Get all of the comments for the status_selesai
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pesanan(): HasMany
    {
        return $this->hasMany(Order::class, 'status_selesai_id', 'id');
    }
}
