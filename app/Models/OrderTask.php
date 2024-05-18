<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Class OrderTask
 *
 * @property int $task_id
 * @property int $order_id
 * @property int $assigned_to
 * @property string|null $task_type
 * @property string|null $status
 * @property string|null $comments
 * @property Carbon|null $created_at
 * @property Carbon|null $completed_at
 * @property Carbon|null $updated_at
 */
class OrderTask extends Model
{
    use HasFactory;

    protected $primaryKey = 'task_id';

    protected $fillable = [
        'order_id',
        'assigned_to',
        'task_type',
        'status',
        'comments',
        'created_at',
        'completed_at',
    ];
}
