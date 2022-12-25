<?php

namespace Modules\Authorization\Http\Requests\V1\Roles;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

#[
    OA\Schema(
        title: "CreateRoleRequest",
        properties: [
            new OA\Property(
                property: "name",
                type: "string",
                example: "admin",
            ),
        ],
        type: "object",
    )
]
class CreateRoleRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            "name" => "required|string|max:64|unique:roles"
        ];
    }
}
