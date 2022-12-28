<?php

namespace Modules\Authorization\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Authorization\Database\Factories\RoleFactory;
use Modules\Authorization\Services\V1\Permissions\Traits\HasPermissions;

/**
 * @property int $id
 * @property string $name
 * @property int $created_by
 * @property int $updated_by
 */
class Role extends Model
{
    use HasFactory, HasPermissions, SoftDeletes;

    protected $fillable = [
        "name",
        "created_by",
        "updated_by"
    ];

    /**
     * @return RoleFactory
     */
    protected static function newFactory(): RoleFactory
    {
        return RoleFactory::new();
    }
}
