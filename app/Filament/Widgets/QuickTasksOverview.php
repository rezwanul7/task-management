<?php

namespace App\Filament\Widgets;

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use App\Models\Task;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class QuickTasksOverview extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Task::query()
                    ->where('status', TaskStatus::PROGRESS->value)
                    ->orWhere(function ($query) {
                        $query->where('priority', TaskPriority::HIGH->value)
                            ->where('status', '!=', TaskStatus::COMPLETED->value);
                    })
            )
            ->paginated(false)
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('priority')
                    ->badge()
                    ->formatStateUsing(fn(TaskPriority $state): string => $state->label())
                    ->color(fn(TaskPriority $state): string => $state->color()),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(fn(TaskStatus $state): string => $state->label())
                    ->color(fn(TaskStatus $state): string => $state->color()),

                Tables\Columns\TextColumn::make('assignedTo.name')
                    ->label('Assigned To'),

                Tables\Columns\TextColumn::make('assignedBy.name')
                    ->label('Assigned By'),
            ]);
    }
}
