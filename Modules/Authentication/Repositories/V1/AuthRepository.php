<?php

namespace Modules\Authentication\Repositories\V1;

use Illuminate\Database\Eloquent\Model;
use Modules\User\Models\User;

class AuthRepository implements AuthRepositoryInterface
{
    /**
     * @param $params
     * @return Model
     */
    public function storeUser($params): Model
    {
        // encryption password when creating user in database
        return User::query()->create($params);
    }
}
