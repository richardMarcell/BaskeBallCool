<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Status extends Model
{
    use HasFactory;
    protected $table = 'status';


    /**
     * Get all of the join for the status
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function join(): HasMany
    {
        return $this->hasMany(Join::class, 'status_id', 'id');
    }
}
