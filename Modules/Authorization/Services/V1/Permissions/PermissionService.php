<?php

namespace Modules\Authorization\Services\V1\Permissions;

use Modules\Authorization\Repositories\V1\Permissions\PermissionRepositoryInterface;

class PermissionService
{
    private PermissionRepositoryInterface $permissionRepository;

    /**
     * @param PermissionRepositoryInterface $permissionRepository
     */
    public function __construct(PermissionRepositoryInterface $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * @param array $parameters
     * @param int $userId
     * @return array
     */
    public function storePermission(array $parameters, int $userId): array
    {
        $parameters += ["created_by" => $userId];
        $permission = $this->permissionRepository->create($parameters);
        return $this->getById($permission->id);
    }

    /**
     * @param int $permissionId
     * @return array
     */
    public function getById(int $permissionId): array
    {
        return $this->permissionRepository->getById($permissionId);
    }
}
