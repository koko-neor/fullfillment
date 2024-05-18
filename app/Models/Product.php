<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Class Product
 *
 * @property int $product_id
 * @property int $organization_id
 * @property int $warehouse_id
 * @property string|null $name
 * @property string|null $sku
 * @property int|null $stock_quantity
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'product_id';

    protected $fillable = [
        'organization_id',
        'warehouse_id',
        'name',
        'sku',
        'stock_quantity',
    ];
}
