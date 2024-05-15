<?php

namespace App\Repository\Eloquent;

use App\Repository\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class BaseRepository implements EloquentRepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function create(array $data) : Model
    {
        return $this->model->create($data);
    }

    public function all() : Collection
    {
        return $this->model->all();
    }

    public function update(int $id, array $data) : bool
    {
        return $this->model->where('id', $id)->update($data);
    }

    public function delete(int $id) : bool
    {
        return $this->model->where('id', $id)->delete();
    }
}
