<?php

namespace App\Repository\Eloquent;

use App\Models\Task;
use App\Repository\TaskRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;

class TaskRepository extends BaseRepository implements TaskRepositoryInterface
{
    public function __construct(Task $model)
    {
        parent::__construct($model);
    }

    public function allNested($tasks = null) : Collection
    {
        if (is_null($tasks)) {
            $tasks = $this->model->whereNull('parent_id')->get();
        }

        foreach ($tasks as $task) {
            if ($task->childs->isNotEmpty()) {
                $this->allNested($task->childs);
            }
        }

        return $tasks;
    }

    public function filter() : Collection
    {
        return $this->model->filter()->sort()->get();
    }

    public function search(string $str) : Collection
    {
        $results = $this->model->whereFullText(['title', 'description'], $str)->get();
        return $results;
    }

    public function complete(Task $task) : bool
    {
        $task->status = 'done';
        $task->completed_at = Carbon::now()->toDateTimeString();
        return $task->save();
    }
}
