<?php

namespace Modules\Authentication\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

#[
    OA\Schema(
        title: "RegisterRequest",
        properties: [
            new OA\Property(
                property: "first_name",
                type: "string",
                maximum: 100,
                example: "Mohsen",
                nullable: false,
            ),
            new OA\Property(
                property: "last_name",
                type: "string",
                maximum: 100,
                example: "Abedy",
                nullable: false,
            ),
            new OA\Property(
                property: "email",
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
            "first_name" => "required|max:100",
            "last_name" => "required|max:100",
            "email" => "required|email",
            "password" => "required|confirmed"
        ];
    }
}
