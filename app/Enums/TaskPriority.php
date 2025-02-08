<?php

namespace App\Enums;


use App\Contracts\HasDisplayAttributes;
use App\Traits\HasLabels;

enum TaskPriority: string implements HasDisplayAttributes
{
    use InteractWithEnum;
    use HasLabels;

    case LOW = 'low';
    case MEDIUM = 'medium';
    case HIGH = 'high';


    public function label(): string
    {
        return match($this)
        {
            self::LOW => 'Low',
            self::MEDIUM => 'Medium',
            self::HIGH => 'High',
        };
    }

    public function color(): string
    {
        return match($this)
        {
            self::LOW => 'gray',
            self::MEDIUM => 'warning',
            self::HIGH => 'danger',
        };
    }
}
