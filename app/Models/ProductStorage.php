<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Class ProductStorage
 *
 * @property int $storage_id
 * @property int $product_id
 * @property int $block_id
 * @property string|null $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class ProductStorage extends Model
{
    use HasFactory;

    protected $primaryKey = 'storage_id';

    protected $fillable = [
        'product_id',
        'block_id',
        'status',
    ];
}
