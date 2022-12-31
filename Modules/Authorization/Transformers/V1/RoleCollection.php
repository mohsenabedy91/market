<?php

namespace Modules\Authorization\Transformers\V1;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Request;

class RoleCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return parent::toArray($request);
    }
}
