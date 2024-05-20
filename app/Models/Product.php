<?php

namespace App\Models;

use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Writer;

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

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            $renderer = new ImageRenderer(
                new RendererStyle(400),
                new SvgImageBackEnd()
            );
            $writer = new Writer($renderer);
            $product->sku = base64_encode($writer->writeString(uniqid()));
        });
    }

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class, 'organization_id', 'organization_id');
    }

    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id', 'warehouse_id');
    }
}
