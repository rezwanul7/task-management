<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Blade;

class DeveloperInfoWidget extends Widget
{
    protected static string $view = 'filament.widgets.developer-info-widget';

    protected int|string|array $columnSpan = 'full';

    public function getConsiderHiringBlock()
    {
        return preg_replace(
            '/\*(.*?)\*/',
            '<x-filament::link href="https://rezwanul7.github.io" target="_blank" rel="nofollow noopener">$1</x-filament::link>',
            'A Full-Stack Software Engineer with 8+ years of experience delivering high-quality web & mobile solutions. *Click here* to know more about me.'
        );
    }

    protected function getViewData(): array
    {
        return [
            'considerHiring' => Blade::render($this->getConsiderHiringBlock()),
        ];
    }
}
