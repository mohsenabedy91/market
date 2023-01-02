<?php

namespace Modules\Authorization\Repositories\V1\Roles;

use Modules\Authorization\Models\Role;

class RoleRepository implements RoleRepositoryInterface
{
    /**
     * @param array $params
     * @param int $userId
     * @return array
     */
    public function storeRole(array $params, int $userId): array
    {
        /** @var Role $role */
        $role = Role::query()->create($params);
        $role->created_by = $userId;
        $role->save();

        return $this->getById($role->id);
    }

    /**
     * @param array $params
     * @param int $roleId
     * @return array
     */
    public function updateRole(array $params, int $roleId): array
    {
        Role::query()->whereId($roleId)->update($params);
        return $this->getById($roleId);
    }

    /**
     * @param int $roleId
     * @return array
     */
    public function getById(int $roleId): array
    {
        return Role::query()
            ->with([
                "created_by:id,first_name,last_name",
                "updated_by:id,first_name,last_name"
            ])
            ->whereId($roleId)
            ->first()
            ->toArray();
    }

    /**
     * @param int $roleId
     * @return bool
     */
    public function deleteById(int $roleId): bool
    {
        return Role::query()->whereId($roleId)->delete();
    }

    /**
     * @return array
     */
    public function getRoles(): array
    {
        return Role::query()
            ->with([
                "created_by:id,first_name,last_name",
                "updated_by:id,first_name,last_name"
            ])
            ->get()
            ->toArray();
    }
}
