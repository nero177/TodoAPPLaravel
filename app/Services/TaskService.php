<?php

namespace App\Services;

use App\DTO\TaskDTO;
use App\Enums\TaskStatus;
use App\Models\Task;
use App\Repository\TaskRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Resources\TaskResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TaskService
{
    public function __construct(private TaskRepositoryInterface $taskRepository)
    {
    }

    public function create(TaskDTO $taskDTO) : TaskResource
    {
        $user = auth()->user();

        $task = $this->taskRepository->create([
            'user_id' => $user->id,
            'title' => $taskDTO->title,
            'description' => $taskDTO->description,
            'priority' => $taskDTO->priority,
            'parent_id' => $taskDTO->parent_id
        ]);

        return new TaskResource($task);
    }

    public function all(bool $shouldFilter) : AnonymousResourceCollection
    {
        if ($shouldFilter) {
            $tasks = $this->taskRepository->filter();
            return TaskResource::collection($tasks);
        }

        $tasks = $this->taskRepository->allNested();
        return TaskResource::collection($tasks);
    }

    public function search(string $str) : AnonymousResourceCollection
    {
        $results = $this->taskRepository->search($str);
        return TaskResource::collection($results);
    }

    public function update(int $id, TaskDTO $taskDTO) : bool
    {
        $data = [
            'title' => $taskDTO->title,
            'description' => $taskDTO->description,
            'priority' => $taskDTO->priority,
            'parent_id' => $taskDTO->parent_id
        ];

        $updated = $this->taskRepository->update($id, $data);
        return $updated;
    }

    public function complete(Task $task) : bool
    {
        foreach ($task->childs as $child) {
            if ($child->status->value == TaskStatus::TODO->value) {
                return false;
            }
        }
        
        return $this->taskRepository->complete($task);
    }

    public function delete(Task $task) : bool
    {
        if ($task->status->value == TaskStatus::DONE->value) {
            return false;
        }

        return $this->taskRepository->delete($task->id);
    }
}
