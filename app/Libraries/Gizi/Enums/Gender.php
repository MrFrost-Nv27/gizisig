<?php

namespace App\Libraries\Gizi\Enums;

enum Gender: string
{
    case Pria = 'Laki-laki';
    case Wanita = 'Perempuan';

    public static function fromBiner(int $biner): static
    {
        return match ($biner) {
            0 => static::Wanita,
            1 => static::Pria,
            default => static::Pria,
        };
    }

    public static function forSelect(): array
    {
        return array_column(self::cases(), 'value', 'name');
    }
}