<?php

namespace Modules\Authentication\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

#[
    OA\Schema(
        title: "LoginRequest",
        properties: [
            new OA\Property(
                property: "email",
                type: "email",
                example: "mohsen.abedy@yahoo.com",
                nullable: false,
            ),
            new OA\Property(
                property: "password",
                type: "string",
                example: "12347567dsf",
                nullable: false,
            ),
        ],
        type: "object",
    )
]
class LoginRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            "email" => "required|email",
            "password" => "required|string",
        ];
    }
}
