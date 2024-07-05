<?php

namespace App\Http\Requests\Api\Search;

use App\Models\SubCategory;
use App\Traits\ApiResponseTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SearchRequest extends FormRequest
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
            'sub_category_id' => ['required',  function ($attribute, $value, $fail) {
                $subCategory = SubCategory::whereHas('symptoms', function ($symptom) {
                    $symptom->whereHas('medicines');
                })
                    ->where('id', $value)
                    ->first();
                if (!$subCategory) {
                    $fail('Not Found');
                }
            }],
            'symptom_id' => ['required', 'array'],
            'symptom_id.*' => ['required', Rule::exists('symptoms', 'id')->where('sub_category_id', request()->input('sub_category_id'))],
        ];
    }

    public function failedValidation($validator)
    {
        return ApiResponseTrait::failedValidation($validator, [], "Validation Error", 422);
    }
}
