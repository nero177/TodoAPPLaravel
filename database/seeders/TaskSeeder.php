<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Task;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Task::truncate();

        $tasks = [
            [
                'title' => 'Task 1',
                'description' => 'Parent 1',
                'user_id' => 1,
                'parent_id' => null,
            ],
            [
                'title' => 'Task 2',
                'description' => 'Parent 2 and child of 1',
                'user_id' => 1,
                'parent_id' => 1,
            ],
            [
                'title' => 'Task 3',
                'description' => 'Parent 3 and child of 1',
                'user_id' => 1,
                'parent_id' => 1,
            ],
            [
                'title' => 'Task 4',
                'description' => 'No childs',
                'user_id' => 1,
                'parent_id' => null,
            ],
            [
                'title' => 'Task 5',
                'description' => 'No childs',
                'user_id' => 1,
                'parent_id' => null,
            ],
            [
                'title' => 'Task 6',
                'description' => 'Child of 2',
                'user_id' => 1,
                'parent_id' => 2,
            ],
            [
                'title' => 'Task 7',
                'description' => 'Child of 3',
                'user_id' => 1,
                'parent_id' => 3,
            ],
            [
                'title' => 'Task 8',
                'description' => 'Child of 3',
                'user_id' => 1,
                'parent_id' => 3,
            ],
        ];

        Task::insert($tasks);
    }
}
