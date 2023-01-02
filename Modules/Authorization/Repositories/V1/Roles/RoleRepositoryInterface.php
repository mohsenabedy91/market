<?php

namespace Modules\Authorization\Repositories\V1\Roles;

interface RoleRepositoryInterface
{
    /**
     * @param array $params
     * @param int $userId
     * @return array
     */
    public function storeRole(array $params, int $userId): array;

    /**
     * @param array $params
     * @param int $roleId
     * @return array
     */
    public function updateRole(array $params, int $roleId): array;

    /**
     * @param int $roleId
     * @return array
     */
    public function getById(int $roleId): array;

    /**
     * @param int $roleId
     * @return bool
     */
    public function deleteById(int $roleId): bool;

    /**
     * @return array
     */
    public function getRoles(): array;
}
