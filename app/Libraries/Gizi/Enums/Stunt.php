<?php

namespace App\Libraries\Gizi\Enums;

enum Stunt: int
{
    case Unknown = 0;
    case SeverelyStunted = 1;
    case Stunted = 2;
    case Normal = 3;
    case High = 4;

    public static function fromDescription(int $desc): static
    {
        return match (strtolower($desc)) {
            'severely stunted' => static::SeverelyStunted,
            'stunted' => static::Stunted,
            'normal' => static::Normal,
            'high' => static::High,
            default => static::Unknown,
        };
    }

    public function description(): string
    {
        return match ($this) {
            static::Unknown => 'Tidak diketahui',
            static::SeverelyStunted => 'Severely Stunted',
            static::Stunted => 'Stunted',
            static::Normal => 'Normal',
            static::High => 'High',
        };
    }
}
