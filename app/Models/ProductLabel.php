<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Class ProductLabel
 *
 * @property int $label_id
 * @property int $product_id
 * @property string|null $barcode
 * @property string|null $type
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class ProductLabel extends Model
{
    use HasFactory;

    protected $primaryKey = 'label_id';

    protected $fillable = [
        'product_id',
        'barcode',
        'type',
    ];
}
