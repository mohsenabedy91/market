<?php

namespace Modules\Authorization\Http\Requests\V1\Permissions;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

#[
    OA\Schema(
        title: "CreatePermissionRequest",
        properties: [
            new OA\Property(
                property: "name",
                type: "string",
                example: "create permission",
            ),
        ],
        type: "object",
    )
]
class CreatePermissionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            "name" => "required|string|max:64|unique:permissions"
        ];
    }
}
