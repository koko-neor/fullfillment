<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Class ReturnOrder
 *
 * @property int $return_id
 * @property int $order_detail_id
 * @property string|null $reason
 * @property Carbon|null $date_returned
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class ReturnOrder extends Model
{
    use HasFactory;

    use HasFactory;

    protected $primaryKey = 'return_id';

    protected $fillable = [
        'order_detail_id',
        'reason',
        'date_returned',
    ];
}
