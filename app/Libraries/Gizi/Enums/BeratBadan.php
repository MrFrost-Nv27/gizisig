<?php

namespace App\Libraries\Gizi\Enums;

enum BeratBadan: int
{
    case Unknown = 0;
    case SeverelyUnderweight = 1;
    case Underweight = 2;
    case Normal = 3;
    case RiskOverweight = 4;

    public static function fromDescription(string $desc): static
    {
        return match (strtolower($desc)) {
            'severely underweight' => static::SeverelyUnderweight,
            'underweight' => static::Underweight,
            'normal' => static::Normal,
            'risk overweight' => static::RiskOverweight,
            default => static::Unknown,
        };
    }

    public function description(): string
    {
        return match ($this) {
            static::SeverelyUnderweight => 'Severely Underweight',
            static::Underweight => 'Underweight',
            static::Normal => 'Normal',
            static::RiskOverweight => 'Risk Overweight',
            static::Unknown => 'Tidak diketahui',
        };
    }
}
