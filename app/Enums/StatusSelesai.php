<?php

namespace App\Enums;

enum StatusSelesai
{

    case MASIH_BERMAIN;
    case SELESAI_BERMAIN;

    public function statusSelesai(): string
    {
        return match($this)
        {
            StatusSelesai::MASIH_BERMAIN => "F001",
            StatusSelesai::SELESAI_BERMAIN => "F002",
        };
    }

}