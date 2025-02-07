<?php

namespace App\Enums;


enum TaskPriority: string
{
    use InteractWithEnum;

    case LOW = 'low';
    case MEDIUM = 'medium';
    case HIGH = 'high';
}
