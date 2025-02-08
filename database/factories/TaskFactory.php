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

    public function definition(): array
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
            'due_at' => $this->faker->optional()->dateTimeBetween('now', '+7 days'),
            'start_at' => now(),
            'end_at' => $this->faker->optional()->dateTimeBetween('now', '+7 days'),
            'assigned_to_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            'assigned_by_id' => User::first()->id ?? User::factory(), // Assign to first user(admin) if exists
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    public function assignTo(User $user): TaskFactory
    {
        return $this->state(function (array $attributes) use ($user) {
            return [
                'assigned_to_id' => $user->id ?? User::factory(),
            ];
        });
    }
}
