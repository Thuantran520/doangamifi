<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email'    => 'required|email',
            'password' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required'    => 'Email là bắt buộc.',
            'email.email'       => 'Email không hợp lệ.',
            'email.exists'      => 'Email không tồn tại.',
            'password.required' => 'Mật khẩu là bắt buộc.',
            'password.incorrect' => 'Mật khẩu không chính xác.',
        ];
    }
}
