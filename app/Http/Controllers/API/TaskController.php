<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\ApiBaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaginatedQueryBuilderRequest;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskCollection;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Response;
use Knuckles\Scribe\Attributes\ResponseFromApiResource;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * @group Task Management
 *
 * APIs to manage the task resource.
 * */
class TaskController extends ApiBaseController
{
    /**
     * List all Tasks
     *
     * Display a listing of the resource.
     */
    #[ResponseFromApiResource(TaskCollection::class, Task::class)]
    public function index(PaginatedQueryBuilderRequest $request): TaskCollection
    {
        $tasks = QueryBuilder::for(Task::class)
            ->allowedFilters('id', 'name')
            ->defaultSort('-created_at')
            ->allowedSorts('id', 'name', 'created_at', 'updated_at')
            ->applyPaginateAble();

        return new TaskCollection($tasks);
    }

    /**
     * Create a Task
     *
     * Stores a newly created task in storage.
     */
    #[ResponseFromApiResource(TaskResource::class, Task::class, Response::HTTP_CREATED)]
    public function store(StoreTaskRequest $request): TaskResource
    {
        $task = Task::create($request->validated());

        return new TaskResource($task);
    }

    /**
     * Fetch a Task
     *
     * Display the specified resource.
     */
    #[ResponseFromApiResource(TaskResource::class, Task::class)]
    public function show(Task $task): TaskResource
    {
        return new TaskResource($task);
    }

    /**
     * Update a Task
     *
     * Update the specified resource in storage.
     */
    #[ResponseFromApiResource(TaskResource::class, Task::class)]
    public function update(UpdateTaskRequest $request, Task $task): TaskResource
    {
        $task->update($request->validated());

        return new TaskResource($task);
    }

    /**
     * Delete a Task
     *
     * Remove the specified resource from storage.
     * @throws \Throwable
     */
    #[\Knuckles\Scribe\Attributes\Response(status: Response::HTTP_NO_CONTENT)]
    public function destroy(Task $task): Response
    {
        $task->delete();

        return response()->noContent();
    }

}
