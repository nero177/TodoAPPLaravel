<?php

namespace App\Enums;

enum TaskStatus: string
{
    case DONE = 'done';
    case TODO = 'todo';
}
