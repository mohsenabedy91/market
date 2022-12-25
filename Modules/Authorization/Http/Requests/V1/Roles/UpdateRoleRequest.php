<?php

namespace Modules\Authorization\Http\Requests\V1\Roles;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use OpenApi\Attributes as OA;

#[
    OA\Schema(
        title: "UpdateRoleRequest",
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
class UpdateRoleRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            "name" => [
                "required",
                "string",
                "max:64",
                Rule::unique('roles')->ignore($this->id)
            ]
        ];
    }
}
