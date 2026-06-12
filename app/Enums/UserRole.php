<?php

namespace App\Enums;

enum UserRole: string
{
    case USER = 'user';
    case PARTNER = 'partner';
    case ADMIN = 'admin';

    /**
     * @return array<int, string>
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
