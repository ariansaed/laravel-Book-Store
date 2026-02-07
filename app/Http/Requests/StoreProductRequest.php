<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:products,name',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'slider' => 'nullable|in:on',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'نام محصول الزامی است.',
            'name.unique' => 'این نام محصول قبلاً ثبت شده است.',
            'category_id.required' => 'انتخاب دسته بندی الزامی است.',
            'category_id.exists' => 'دسته بندی انتخاب شده معتبر نیست.',
            'price.required' => 'قیمت محصول الزامی است.',
            'stock.required' => 'تعداد موجودی الزامی است.',
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->all();

        throw new HttpResponseException(
            response()->json([
                'status' => 'error',
                'errors' => $errors
            ], 422)
        );
    }
}
