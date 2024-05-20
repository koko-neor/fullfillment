<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * Class OrderDetail
 *
 * @property int $detail_id
 * @property int $order_id
 * @property int $product_id
 * @property int|null $quantity_ordered
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class OrderDetail extends Model
{
    use HasFactory;

    protected $primaryKey = 'detail_id';

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity_ordered',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}
