<?php

namespace Modules\Auth\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

#[
    OA\Schema(
        title: "RegisterRequest",
        properties: [
            new OA\Property(
                property: "name",
                type: "string",
                maximum: 255,
                example: "Mohsen Abedy",
                nullable: false,
            ),
            new OA\Property(
                property: "email",
                description: "this is the email address of the users table is unique",
                type: "email",
                example: "mohsen.abedy@yahoo.com",
                nullable: false,
            ),
            new OA\Property(
                property: "password",
                type: "string",
                example: "123456",
                nullable: false,
            ),
            new OA\Property(
                property: "password_confirmation",
                type: "string",
                example: "123456",
                nullable: false,
            ),
        ],
        type: "object",
    )
]
class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            "name" => "required|string|max:255",
            "email" => "required|email|unique:users",
            "password" => "required|confirmed"
        ];
    }
}
