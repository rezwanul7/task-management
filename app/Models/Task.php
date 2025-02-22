<?php

namespace App\Models;

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use App\Observers\TaskObserver;
use App\Traits\PaginateAble;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property User|null $assignedBy
 * @property User|null $assignedTo
 */
#[ObservedBy([TaskObserver::class])]
class Task extends Model
{
    use HasFactory;
    use PaginateAble;
    use SoftDeletes;

    protected $table = 'tasks';

    protected $fillable = [
        'name',
        'description',
        'status',
        'priority',
        'due_at',
        'start_at',
        'end_at',
        'assigned_to_id',
    ];

    protected $casts = [
        'status' => TaskStatus::class,
        'priority' => TaskPriority::class,
        'due_at' => 'datetime',
        'start_at' => 'datetime',
        'end_at' => 'datetime',
    ];

    public function assignedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_by_id');
    }

    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to_id');
    }
}
