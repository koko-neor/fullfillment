<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * Class Order
 *
 * @property int $order_id
 * @property int $organization_id
 * @property int $warehouse_id
 * @property string|null $type
 * @property string|null $marketplace
 * @property Carbon|null $created_at
 * @property string|null $status
 * @property string|null $seller_comments
 * @property string|null $warehouse_comments
 * @property Carbon|null $updated_at
 */
class Order extends Model
{
    use HasFactory;

    protected $primaryKey = 'order_id';

    protected $fillable = [
        'organization_id',
        'warehouse_id',
        'type',
        'marketplace',
        'created_at',
        'status',
        'seller_comments',
        'warehouse_comments',
    ];

    protected $attributes = [
        'status' => 'ожидание',
    ];

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class, 'organization_id', 'organization_id');
    }

    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id', 'warehouse_id');
    }
}
