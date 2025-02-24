<?php

namespace App\Traits;

trait HasLabels
{
    /**
     * Get an array of status labels for Filament
     *  i.e. ['progress' => 'In Progress']
     */
    public static function labels(): array
    {
        return array_combine(
            array_map(fn ($case) => $case->value, self::cases()),
            array_map(fn ($case) => $case->label(), self::cases())
        );
    }
}
