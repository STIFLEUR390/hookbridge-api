<?php

namespace App\Enums;

enum ProjectType: string
{
    case CALLBACK = 'callback';
    case WEBHOOK = 'webhook';

    /**
     * Obtenir toutes les valeurs de l'énumération
     *
     * @return array<string>
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
