<?php

namespace App\Http\Resources;

use App\Enums\TaskStatus;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'priority' => $this->priority,
            'user_id' => $this->user_id,
            'status' => $this->status ?? TaskStatus::TODO->value,
            'childs' => $this->childs,
            'created_at' => $this->created_at,
            'completed_at' => $this->completed_at
        ];
    }
}
