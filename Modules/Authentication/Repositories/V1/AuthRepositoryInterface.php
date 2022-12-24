<?php

namespace Modules\Authentication\Repositories\V1;

use Illuminate\Database\Eloquent\Model;

interface AuthRepositoryInterface
{
    /**
     * @param $params
     * @return Model
     */
    public function storeUser($params): Model;
}
