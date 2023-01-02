<?php

namespace Modules\Authorization\Services\V1\Roles;

use Exception;
use Illuminate\Support\Facades\DB;
use Modules\Authorization\Repositories\V1\Roles\RoleRepositoryInterface;

class RoleService
{
    /**
     * @var RoleRepositoryInterface
     */
    private RoleRepositoryInterface $roleRepository;

    /**
     * @param RoleRepositoryInterface $roleRepository
     */
    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    /**
     * @param array $parameters
     * @param int $userId
     * @return array
     */
    public function storeRole(array $parameters, int $userId): array
    {
        return $this->roleRepository->storeRole($parameters, $userId);
    }

    /**
     * @param array $parameters
     * @param int $roleId
     * @param int $userId
     * @return array
     * @throws Exception
     */
    public function updateRole(array $parameters, int $roleId, int $userId): array
    {
        DB::beginTransaction();
        try {
            $parameters += ["updated_by" => $userId];
            $role = $this->roleRepository->updateRole($parameters, $roleId);
            DB::commit();
            return $role;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * @param int $roleId
     * @return array
     */
    public function getById(int $roleId): array
    {
        return $this->roleRepository->getById($roleId);
    }

    /**
     * @param int $userId
     * @return void
     * @throws Exception
     */
    public function deleteById(int $userId): void
    {
        DB::beginTransaction();
        try {
            $statusDelete = $this->roleRepository->deleteById($userId);
            if ($statusDelete) {
                DB::commit();
            }
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * @return array
     */
    public function getRoles(): array
    {
        return $this->roleRepository->getRoles();
    }
}
