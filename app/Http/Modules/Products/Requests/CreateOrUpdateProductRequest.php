<?php

namespace App\Http\Modules\Products\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateOrUpdateProductRequest extends FormRequest
{
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
            "name" => "required|string",
            "price" => "required|numeric",
            "category_id" => [
                "required",
                "numeric",
                Rule::exists('categories', 'id'),
            ],
            "mark_id" => [
                "required",
                "numeric",
                Rule::exists('marks', 'id'),
            ],
        ];
    }

    /**
     *
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => 'El nombre del producto es requerido',
            'name.string' => 'El nombre del producto debe ser una cadena de texto',
            'price.required' => 'El precio es requerido',
            'price.numeric' => 'El precio debe ser un número',
            'category_id.required' => 'La categoría es requerida',
            'category_id.numeric' => 'La categoría debe ser númerica',
            'category_id.exists' => 'La categoría no existe',
            'mark_id.required' => 'La marca es requerida',
            'mark_id.numeric' => 'La marca debe ser númerica',
            'mark_id.exists' => 'La marca no existe',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 400));
    }
}
