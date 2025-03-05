<?php

namespace App\Filament\Widgets;

use App\Enums\TaskStatus;
use App\Models\Task;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {

        $taskCounts = Task::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');

        $pendingTasksCount = $taskCounts->get(TaskStatus::PENDING->value, 0);
        $inProgressTasksCount = $taskCounts->get(TaskStatus::PROGRESS->value, 0);
        $completedTasksCount = $taskCounts->get(TaskStatus::COMPLETED->value, 0);

        return [

            Stat::make('Pending Tasks', $pendingTasksCount)
                ->description('Tasks yet to be started')
                ->icon('heroicon-o-clock')
                ->color('warning'),

            Stat::make('In Progress Tasks', $inProgressTasksCount)
                ->description('Currently being worked on')
                ->icon('heroicon-o-adjustments-horizontal')
                ->color('info'),

            Stat::make('Completed Tasks', $completedTasksCount)
                ->description('Successfully finished tasks')
                ->icon('heroicon-o-check-circle')
                ->color('success'),
        ];
    }
}
