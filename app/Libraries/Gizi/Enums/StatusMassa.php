<?php

namespace App\Libraries\Gizi\Enums;

enum StatusMassa: int
{
    case Unknown = 0;
    case SeverelyThinness = 1;
    case Thinness = 2;
    case Normal = 3;
    case Overweight = 4;
    case Obese = 6;

    public static function fromDescription(int $desc): static
    {
        return match (strtolower($desc)) {
            'severely thinness' => static::SeverelyThinness,
            'thinness' => static::Thinness,
            'normal' => static::Normal,
            'overweight' => static::Overweight,
            'obese' => static::Obese,
            default => static::Unknown,
        };
    }

    public function description(): string
    {
        return match ($this) {
            static::SeverelyThinness => 'Severely Thinness',
            static::Thinness => 'Thinness',
            static::Normal => 'Normal',
            static::Overweight => 'Overweight',
            static::Obese => 'Obese',
            default => 'Unknown',
        };
    }
}
