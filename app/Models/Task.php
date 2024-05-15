<?php

namespace App\Models;

use Abbasudo\Purity\Traits\Filterable;
use Abbasudo\Purity\Traits\Sortable;
use App\Enums\TaskStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    use HasFactory;
    use Filterable;
    use Sortable;

    protected $fillable = [
        'user_id',
        'parent_id',
        'title',
        'description',
        'priority',
        'status',
    ];

    protected $filterFields = [
        'title',
        'description',
        'priority',
        'status',
        'childs',
    ];

    protected $casts = [
        'status' => TaskStatus::class
    ];

    public function childs() : HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }
}
