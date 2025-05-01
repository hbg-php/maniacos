<?php

namespace app\Enums;

enum Category: int
{
    case SUB_15 = 1;
    case SUB_16 = 2;
    case SUB_17 = 3;
    case SUB_18 = 4;
    case SUB_19 = 5;
    case SUB_20 = 6;
    case SUB_21 = 7;
    case SUB_22 = 8;
    case ADULTO = 9;

    public function label(): string
    {
        return match ($this) {
            self::SUB_15 => 'Sub 15',
            self::SUB_16 => 'Sub 16',
            self::SUB_17 => 'Sub 17',
            self::SUB_18 => 'Sub 18',
            self::SUB_19 => 'Sub 19',
            self::SUB_20 => 'Sub 20',
            self::SUB_21 => 'Sub 21',
            self::SUB_22 => 'Sub 22',
            self::ADULTO => 'Adulto',
        };
    }

    public static function getLabelFromValue(int $value): string
    {
        return self::from($value)->label();
    }

}
