<?php

namespace Modules\Authorization\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Authorization\Database\Factories\PermissionFactory;
use Modules\Authorization\Services\Roles\Traits\HasRoles;

/**
 * @property string $name
 */
class Permission extends Model
{
    use HasFactory, HasRoles;

    protected $fillable = [];

    /**
     * @return PermissionFactory
     */
    protected static function newFactory(): PermissionFactory
    {
        return PermissionFactory::new();
    }
}
