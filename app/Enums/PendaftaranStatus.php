<?php

namespace App\Enums;

enum PendaftaranStatus: int
{
    case Buka = 1;
    case Tutup = 0;

    public function label(): string
    {
        return match ($this) {
            self::Tutup => 'Tutup',
            self::Buka => 'Buka',
        };
    }
}
