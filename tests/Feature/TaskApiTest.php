<?php

use App\Models\Task;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

use function Pest\Laravel\postJson;

beforeEach(function () {
    // Create a user and authenticate
    $this->user = User::factory()->create();

    Sanctum::actingAs(
        $this->user,
        ['task:create', 'task:update', 'task:delete']
    );

});

test('authenticated user can store a task', function () {
    $taskData = [
        'name' => 'Task 1',
        'description' => 'Description of Task 1',
        'assigned_to_id' => User::factory()->create()->id,
    ];

    $response = postJson('/api/tasks', $taskData);

    $response
        ->assertStatus(201)
        ->assertJsonFragment($taskData);

    $this->assertDatabaseHas('tasks', $taskData);
});

test('authenticated user can list all the tasks', function () {
    $response = $this->getJson('/api/tasks');

    $response->assertStatus(200);

    $response->assertJsonStructure([
        'data' => [
            '*' => [
                'id',
                'name',
                'description',
                'assigned_to_id',
                'created_at',
                'updated_at',
            ],
        ],
    ]);
});

test('authenticated user can fetch a task', function () {
    $task = Task::factory()->create();

    $response = $this->getJson("/api/tasks/{$task->id}");

    $response->assertStatus(200);
});

test('authenticated user can delete a task', function () {
    $task = Task::factory()->create();

    $response = $this->deleteJson("/api/tasks/{$task->id}");

    $response->assertNoContent();
});
