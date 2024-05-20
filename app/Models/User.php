<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Carbon;

/**
 * Class User
 *
 * @property int $user_id
 * @property string|null $username
 * @property string|null $password
 * @property int $role_id
 * @property int $organization_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username', 'password', 'role_id', 'organization_id', 'is_superadmin',
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    public function setRememberToken($value)
    {
    }

    public function getRememberToken()
    {
        return null;
    }

    public function getRememberTokenName(): string
    {
        return 'remember_token';
    }

}
