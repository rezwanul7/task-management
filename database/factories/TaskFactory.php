<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use App\Enums\TaskStatus;
use App\Enums\TaskPriority;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition()
    {
        $supportTasks = [
            'Resolve login issue for customer',
            'Investigate and fix checkout errors',
            'Follow up on a refund request',
            'Reset password for VIP customer',
            'Check and respond to negative review',
            'Escalate critical bug in mobile app',
            'Investigate missing order complaint',
            'Provide status update on support ticket #1234',
            'Verify customer identity for account recovery',
            'Resolve billing dispute',
            'Assist customer with feature request',
            'Fix email notification failure',
            'Help customer with subscription cancellation',
            'Check slow website performance report',
            'Respond to compliance-related inquiry',
            'Handle fraudulent account investigation',
            'Coordinate with engineering team for API issue',
            'Provide training material for new support agents',
            'Update knowledge base with latest fixes',
            'Audit support ticket response times'
        ];

        return [
            'title' => $this->faker->randomElement($supportTasks),
            'description' => $this->faker->sentence,
            'status' => $this->faker->randomElement(TaskStatus::values()),
            'priority' => $this->faker->randomElement(TaskPriority::values()),
            'due_time' => $this->faker->optional()->dateTimeBetween('now', '+7 days'),
            'start_time' => now(),
            'end_time' => $this->faker->optional()->dateTimeBetween('now', '+7 days'),
            'assigned_to_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            'assigned_by_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
