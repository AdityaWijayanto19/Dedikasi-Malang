<?php

namespace App\Enums;

enum UserStatus: int
{
    case Block = 0;
    case Active = 1;

    public function label(): string
    {
        return match($this){
            self::Block => 'Block',
            self::Active => 'Aktif',
        };
    }
}
