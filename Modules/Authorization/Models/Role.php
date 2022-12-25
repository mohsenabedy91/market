<?php

namespace Modules\Authorization\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Authorization\Database\Factories\RoleFactory;
use Modules\Authorization\Services\Permissions\Traits\HasPermissions;

/**
 * @property string $name
 */
class Role extends Model
{
    use HasFactory, HasPermissions;

    protected $fillable = [];

    /**
     * @return RoleFactory
     */
    protected static function newFactory(): RoleFactory
    {
        return RoleFactory::new();
    }
}
