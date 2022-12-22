<?php

namespace Modules\Auth\Repositories\V1;

use Modules\User\Models\User;

interface AuthRepositoryInterface
{
    /**
     * @param $params
     * @return User
     */
    public function storeUser($params): User;
}
