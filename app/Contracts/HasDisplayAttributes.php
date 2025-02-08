<?php

namespace App\Contracts;

interface HasDisplayAttributes
{
    public static function labels(): array;
    public function label(): string;
    public function color(): string;
}
