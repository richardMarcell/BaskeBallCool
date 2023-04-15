<?php

namespace App\Enums;

enum StatusIzin 
{

    case YA;
    case TIDAK;

    public function statusIzin() : string
    {
        return match($this)
        {
            StatusIzin::YA => "ya",
            StatusIzin::TIDAK => "tidak", 
        };
    }
    
}