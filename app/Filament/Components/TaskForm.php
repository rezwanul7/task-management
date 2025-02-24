<?php

namespace App\Filament\Components;

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use Filament\Forms;
use Illuminate\Validation\Rules\Enum;

class TaskForm
{
    public static function schema(): array
    {
        return [
            Forms\Components\TextInput::make('name')
                ->required()
                ->minLength(3)
                ->maxLength(255),

            Forms\Components\Textarea::make('description')
                ->maxLength(500)
                ->nullable(),

            Forms\Components\Select::make('status')
                ->options(TaskStatus::labels())
                ->default(TaskStatus::PENDING)
                ->required()
                ->rule(new Enum(TaskStatus::class)),

            Forms\Components\Select::make('priority')
                ->options(TaskPriority::labels()) // Use enum labels instead of hardcoded values
                ->default(TaskPriority::MEDIUM)
                ->required()
                ->rule(new Enum(TaskPriority::class)),

            Forms\Components\DateTimePicker::make('due_at')
                ->nullable()
                ->after('today'), // Ensures due time is in the future

            Forms\Components\DateTimePicker::make('start_at')
                ->nullable()
                ->before('due_at'), // Ensures start time is before due time

            Forms\Components\DateTimePicker::make('end_at')
                ->nullable()
                ->after('start_at'), // Ensures end time is after start time

            Forms\Components\Select::make('assigned_to_id')
                ->relationship('assignedTo', 'name')
                ->searchable()
                ->required()
                ->exists('users', 'id'), // Ensures user exists in the database
        ];
    }
}
