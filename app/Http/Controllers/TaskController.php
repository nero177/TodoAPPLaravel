<?php

namespace App\Http\Controllers;

use App\DTO\TaskDTO;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Services\TaskService;
use App\Http\Requests\TaskCreateRequest;
use App\Http\Requests\TaskUpdateRequest;

class TaskController extends Controller
{
    public function __construct(private TaskService $taskService)
    {
        $this->middleware('auth:api');
    }

    public function create(TaskCreateRequest $request) : JsonResponse
    {
        $taskDTO = new TaskDTO($request->title, $request->description, $request->priority, $request->parent_id);
        $task = $this->taskService->create($taskDTO);

        return response()->json([
            'status' => 'success',
            'task' => $task
        ]);
    }

    public function update(TaskUpdateRequest $request, int $id) : JsonResponse
    {
        $taskDTO = new TaskDTO($request->title, $request->description, $request->priority, $request->parent_id);
        $updated = $this->taskService->update($id, $taskDTO);

        if (! $updated) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong'
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Task updated successfuly'
        ]);
    }

    public function complete(Request $request, Task $id) : JsonResponse
    {
        $updated = $this->taskService->complete($id);

        if (! $updated) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong, maybe you should complete all subtasks first'
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Task completed'
        ]);
    }

    public function all(Request $request) : JsonResponse
    {
        $tasks = $this->taskService->all(isset($request->filters) || isset($request->sort));

        return response()->json([
            'tasks' => $tasks,
        ]);
    }

    public function search(Request $request, string $str) : JsonResponse
    {
        $tasks = $this->taskService->search($str);

        return response()->json([
            'results' => $tasks,
        ]);
    }

    public function delete(Request $request, Task $id) : JsonResponse
    {
        $deleted = $this->taskService->delete($id);

        if (! $deleted) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong'
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Task deleted successfuly'
        ]);
    }
}
