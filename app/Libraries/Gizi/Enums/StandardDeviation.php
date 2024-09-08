<?php

namespace App\Libraries\Gizi\Enums;

enum StandardDeviation: int
{
    case Unknown = 0;
    case Min3SD = 1;
    case Min2SD = 2;
    case Min1SD = 3;
    case Median = 4;
    case Plus1SD = 5;
    case Plus2SD = 6;
    case Plus3SD = 7;

    public static function fromDescription(string $desc): static
    {
        return match (strtoupper($desc)) {
            '-3SD' => static::Min3SD,
            '-2SD' => static::Min2SD,
            '-1SD' => static::Min3SD,
            'MEDIAN' => static::Median,
            '+1SD' => static::Plus1SD,
            '+2SD' => static::Plus2SD,
            '+3SD' => static::Plus3SD,
            default => static::Unknown,
        };
    }

    public function description(): string
    {
        return match ($this) {
            static::Min3SD => '-3SD',
            static::Min2SD => '-2SD',
            static::Min1SD => '-1SD',
            static::Median => 'Median',
            static::Plus1SD => '+1SD',
            static::Plus2SD => '+2SD',
            static::Plus3SD => '+3SD',
            default => 'Tidak diketahui',
        };
    }
}
