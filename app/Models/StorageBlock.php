<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Class StorageBlock
 *
 * @property int $block_id
 * @property int $warehouse_id
 * @property string|null $type
 * @property string|null $location
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class StorageBlock extends Model
{
    use HasFactory;

    protected $primaryKey = 'block_id';

    protected $fillable = [
        'warehouse_id',
        'type',
        'location',
    ];
}
