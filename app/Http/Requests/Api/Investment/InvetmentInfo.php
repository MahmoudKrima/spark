<?php

namespace App\Http\Requests\Api\Investment;

use App\Traits\ApiResponseTrait;
use Illuminate\Foundation\Http\FormRequest;

class InvetmentInfo extends FormRequest
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
            'age' => ['required', 'numeric', 'min:15', 'max:90'],
            'edu_level' => ['required', 'numeric', 'in:1,2,3,4'],
            'married' => ['required', 'in:1,2'],
            'kids' => ['required', 'integer', 'min:0', 'max:15'],
            'life_stage' => ['required', 'numeric', 'in:1,2,3,4,5,6'],
            'occu_category' => ['required', 'numeric', 'in:1,2,3,4'],
            'income' => ['required', 'numeric', 'min:1'],
            'risk' => ['required','in:1,2,3,4'],
            'eager' => ['required', 'in:0,1'],
            'investment_amount' => ['required', 'numeric', 'min:1'],
            'end_date' => ['required', 'date', 'date_format:Y-m-d'],
        ];
    }

    public function failedValidation($validator)
    {
        return ApiResponseTrait::failedValidation($validator, [], "Validation Error", 422);
    }
}
