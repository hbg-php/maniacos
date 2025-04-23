<?php

namespace app\Enums;

enum Position: int
{
    case PointGuard = 1; // Armador
    case ShootingGuard = 2; // Ala-armador
    case SmallForward = 3; // Ala
    case PowerForward = 4; // Ala-pivô
    case Center = 5; // Pivô

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
