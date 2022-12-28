<?php

namespace Modules\Authorization\Repositories\V1\Permissions;

interface PermissionRepositoryInterface
{
    /**
     * @param $params
     * @return array
     */
    public function storePermission($params): array;
}
