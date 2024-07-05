<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Validation\Rule;
use App\Traits\ApiResponseTrait;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    use ApiResponseTrait;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6', 'max:15', 'confirmed']
        ];
    }

    public function failedValidation($validator)
    {
        return ApiResponseTrait::failedValidation($validator, [], "Validation Error", 422);
    }
}
