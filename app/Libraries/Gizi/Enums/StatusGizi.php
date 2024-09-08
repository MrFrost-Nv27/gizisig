<?php

namespace App\Libraries\Gizi\Enums;

enum StatusGizi: int
{
    case Unknown = 0;
    case SeverelyWasted = 1;
    case Wasted = 2;
    case Normal = 3;
    case RiskOverweight = 4;
    case Overweight = 5;
    case Obese = 6;

    public static function fromDescription(int $desc): static
    {
        return match (strtolower($desc)) {
            'severely wasted' => static::SeverelyWasted,
            'wasted' => static::Wasted,
            'normal' => static::Normal,
            'risk overweight' => static::RiskOverweight,
            'overweight' => static::Overweight,
            'obese' => static::Obese,
            default => static::Unknown,
        };
    }

    public function description(): string
    {
        return match ($this) {
            static::Unknown => 'Tidak diketahui',
            static::SeverelyWasted => 'Severely Wasted',
            static::Wasted => 'Wasted',
            static::Normal => 'Normal',
            static::RiskOverweight => 'Risk Overweight',
            static::Overweight => 'Overweight',
            static::Obese => 'Obese',
        };
    }
}
