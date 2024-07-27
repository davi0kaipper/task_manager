<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Task::all()->toArray());
    }

    public function create(CreateTaskRequest $request): JsonResponse
    {
        $taskData = $request->all();

        $task = Task::create($taskData);

        return response()->json([$task], 201);
    }
}
