<?php

namespace App\Enums;

enum StatusPostingan: int
{
    case Draft = 0;
    case Publish = 1;

    public function label(): string
    {
        return match($this){
            self::Draft => 'Draft',
            self::Publish => 'Publish',
        };
    }
}
