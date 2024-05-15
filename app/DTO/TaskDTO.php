<?php

namespace App\DTO;

class TaskDTO
{
    public string $title;
    public string $description;
    public ?int $priority;
    public ?int $parent_id;

    public function __construct(
        string $title,
        string $description,
        ?int $priority,
        ?int $parent_id,
    ) {
        $this->title = $title;
        $this->description = $description;
        $this->priority = $priority ?? 1;
        $this->parent_id = $parent_id;
    }
}
