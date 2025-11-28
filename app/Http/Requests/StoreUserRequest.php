<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * 
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role'     => ['sometimes', 'in:user,admin'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'     => 'وارد کردن نام الزامی است.',
            'name.max'          => 'نام نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.',
            'email.required'   => 'ایمیل الزامی است.',
            'email.email'      => 'فرمت ایمیل صحیح نیست.',
            'email.unique'     => 'این ایمیل قبلاً ثبت شده است.',
            'password.required' => 'رمز عبور الزامی است.',
            'password.min'      => 'رمز عبور باید حداقل ۸ کاراکتر باشد.',
            'password.confirmed' => 'تکرار رمز عبور مطابقت ندارد.',
        ];
    }
}
