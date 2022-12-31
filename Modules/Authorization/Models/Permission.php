<?php

namespace Modules\Authorization\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Authorization\Database\Factories\PermissionFactory;
use Modules\Authorization\Services\V1\Roles\Traits\HasRoles;

/**
 * @property int $id
 * @property string $name
 * @property int $created_by
 * @property int $updated_by
 */
class Permission extends Model
{
    use HasFactory, HasRoles, SoftDeletes;

    protected $fillable = [
        "name",
        "created_by",
        "updated_by"
    ];

    /**
     * @return PermissionFactory
     */
    protected static function newFactory(): PermissionFactory
    {
        return PermissionFactory::new();
    }
}
