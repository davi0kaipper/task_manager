<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Task::all()->toArray());
    }

    public function create(CreateTaskRequest $request): JsonResponse
    {
        $taskData = $request->all();

        $task = Task::create([
            'description' => $taskData['description'],
            'user_id' => $request->user()->id
        ]);

        return response()->json($task, 201);
    }

    public function update(string $id, UpdateTaskRequest $request): JsonResponse
    {
        $task = Task::firstWhere('id', '=', $id);

        if (! $task) {
            return response()->json(['Task not found.'], 404);
        }

        $taskData = $request->all();

        $task->update([
            'description' => $taskData['description'],
            'completed' => $taskData['completed'],
        ]);

        return response()->json([
            'message' => 'Task updated.',
            'task' => $task
        ], 200);
    }
    public function delete(string $id): JsonResponse
    {
        $task = Task::firstWhere('id', '=', $id);

        if (! $task) {
            return response()->json(['Task not found.'], 404);
        }

        $taskData = $task->toArray();
        $task->delete();

        return response()->json([
            'message' => 'Task deleted.',
            'task_id' => $taskData['id'],
            'task_description' => $taskData['description']
        ], 200);
    }
}
