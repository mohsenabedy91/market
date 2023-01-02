<?php

namespace Modules\Authorization\Repositories\V1\Permissions;

use App\Repositories\BaseRepository;
use Modules\Authorization\Models\Permission;

class PermissionRepository extends BaseRepository implements PermissionRepositoryInterface
{
    /**
     * @return string
     */
    public function model(): string
    {
        return Permission::class;
    }

    /**
     * @param int $permissionId
     * @return array
     */
    public function getById(int $permissionId): array
    {
        return Permission::query()
            ->with([
                "created_by:id,first_name,last_name",
                "updated_by:id,first_name,last_name"
            ])
            ->whereId($permissionId)
            ->first()
            ->toArray();
    }
}
