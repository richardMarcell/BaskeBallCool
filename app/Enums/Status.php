<?php

namespace App\Enums;

enum Status 
{

    case BELUM_DIKONFIRMASI;
    case DITERIMA;
    case DITOLAK;

    public function status() : string
    {
        return match($this)
        {
            Status::BELUM_DIKONFIRMASI => "S001",
            Status::DITERIMA => "S002",
            Status::DITOLAK => "S003",
        };
    }
    
}
