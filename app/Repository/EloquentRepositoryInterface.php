<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

interface EloquentRepositoryInterface
{
    public function create(array $data) : Model;
    
    public function all() : Collection;

    public function update(int $id, array $data) : bool;

    public function delete(int $id) : bool;
}
