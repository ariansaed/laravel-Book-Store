<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateProductRequest extends FormRequest
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
            'name'        => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'slider'     => 'nullable|in:on',
        ];
    }
    protected function prepareForValidation()
    {
        $this->merge([
            'name'        => $this->input('name'),
            'category_id' => $this->input('category_id'),
            'description' => $this->input('description'),
            'price'       => $this->input('price'),
            'stock'       => $this->input('stock'),
        ]);
    }

    public function messages(): array
    {
        return [
            'name.required'        => 'نام محصول الزامی است.',
            'category_id.required' => 'دسته‌بندی الزامی است.',
            'category_id.exists'   => 'دسته‌بندی انتخاب شده معتبر نیست.',
            'price.required'       => 'قیمت محصول الزامی است.',
            'price.numeric'        => 'قیمت باید عددی باشد.',
            'stock.required'       => 'موجودی الزامی است.',
            'stock.integer'        => 'موجودی باید عدد صحیح باشد.',
        ];
    }

    /**
     * 🔥 مهم‌ترین بخش برای هماهنگی با SweetAlert
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status' => 'error',
                'errors' => $validator->errors()->all(),
            ], 422)
        );
    }
}
