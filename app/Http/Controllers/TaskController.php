<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
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
}
