<?php

namespace app\Enums;

enum Position: int
{
    case PointGuard = 1;
    case ShootingGuard = 2;
    case SmallForward = 3;
    case PowerForward = 4;
    case Center = 5;

    public function label(): string
    {
        return match ($this) {
            self::PointGuard => 'Armador (Point Guard)',
            self::ShootingGuard => 'Ala-armador (Shooting Guard)',
            self::SmallForward => 'Ala (Small Forward)',
            self::PowerForward => 'Ala-pivô (Power Forward)',
            self::Center => 'Pivô (Center)',
        };
    }
}
