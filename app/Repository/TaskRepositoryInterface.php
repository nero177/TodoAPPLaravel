<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Collection;

interface TaskRepositoryInterface
{
    public function allNested() : Collection;
    
    public function filter() : Collection;
}
