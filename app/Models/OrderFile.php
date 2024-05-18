<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Class OrderFile
 *
 * @property int $file_id
 * @property int $task_id
 * @property int $uploaded_by
 * @property string|null $file_path
 * @property string|null $file_type
 * @property Carbon|null $uploaded_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class OrderFile extends Model
{
    use HasFactory;

    protected $primaryKey = 'file_id';

    protected $fillable = [
        'task_id',
        'uploaded_by',
        'file_path',
        'file_type',
        'uploaded_at',
    ];
}
