<?php

namespace Modules\Auth\Repositories\V1;

use Modules\User\Models\User;

class AuthRepository implements AuthRepositoryInterface
{
    /**
     * @param $params
     * @return User
     */
    public function storeUser($params): User
    {
        return User::query()->create($params);
    }
}
