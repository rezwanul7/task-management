<?php

namespace App\Filament\Pages;

use App\Enums\TaskStatus;
use App\Filament\Components\TaskForm;
use App\Filament\Resources\TaskResource;
use App\Models\Task;
use Mokhosh\FilamentKanban\Pages\KanbanBoard;

class TasksKanbanBoard extends KanbanBoard
{
    protected static ?string $navigationLabel = 'Tasks Board';
    protected static ?string $navigationIcon = 'heroicon-o-table-cells';

    protected static string $model = Task::class;
    protected static string $statusEnum = TaskStatus::class;

    protected static string $recordTitleAttribute = 'name';

    protected function getEditModalFormSchema(null|int $recordId): array
    {
        return TaskForm::schema();
    }
}
