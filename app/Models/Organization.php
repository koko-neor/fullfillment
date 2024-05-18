<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Class Organization
 *
 * @property int $organization_id
 * @property string|null $name
 * @property string|null $type
 * @property string|null $address
 * @property string|null $contact_number
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Organization extends Model
{
    use HasFactory;

    protected $primaryKey = 'organization_id';

    protected $fillable = [
        'name',
        'type',
        'address',
        'contact_number',
    ];
}
