<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Class StockEntry
 *
 * @property int $entry_id
 * @property int $product_id
 * @property int $warehouse_id
 * @property int|null $quantity_received
 * @property Carbon|null $date_received
 * @property string|null $comments
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class StockEntry extends Model
{
    use HasFactory;

    protected $primaryKey = 'entry_id';

    protected $fillable = [
        'product_id',
        'warehouse_id',
        'quantity_received',
        'date_received',
        'comments',
    ];
}
