<?php

namespace App\Enums;

use App\Contracts\HasDisplayAttributes;
use App\Traits\HasLabels;
use Mokhosh\FilamentKanban\Concerns\IsKanbanStatus;

enum TaskStatus: string implements HasDisplayAttributes
{
    use InteractWithEnum;
    use IsKanbanStatus;
    use HasLabels;

    case PENDING = 'pending';
    case PROGRESS = 'progress';
    case COMPLETED = 'completed';


    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'Pending',
            self::PROGRESS => 'In Progress',
            self::COMPLETED => 'Completed',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::PENDING => 'gray',
            self::PROGRESS => 'warning',
            self::COMPLETED => 'success',
        };
    }
}
