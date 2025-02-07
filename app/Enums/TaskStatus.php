<?php

namespace App\Enums;

use Mokhosh\FilamentKanban\Concerns\IsKanbanStatus;

enum TaskStatus: string
{
    use InteractWithEnum;
    use IsKanbanStatus;

    case PENDING = 'pending';
    case PROGRESS = 'progress';
    case COMPLETED = 'completed';
}
