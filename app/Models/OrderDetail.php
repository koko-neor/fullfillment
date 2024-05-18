<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Class OrderDetail
 *
 * @property int $detail_id
 * @property int $order_id
 * @property int $product_id
 * @property int|null $quantity_ordered
 * @property int $label_id
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
        'label_id',
    ];
}
