<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Cho phép tất cả mọi người có thể gửi request này
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Di chuyển các quy tắc validate từ controller vào đây
        return [
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'username' => 'required|string|max:100|unique:users,username',
            'phone'    => 'nullable|string|max:15|unique:users,phone',
        ];
    }

    /**
     * Get the custom validation messages for the defined rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        // Thêm dòng này để tùy chỉnh thông báo lỗi
        return [
           'email.unique'      => 'Email đã được sử dụng.',
            'username.unique'   => 'Tên đăng nhập đã được sử dụng.',
            'phone.unique'      => 'Số điện thoại đã được sử dụng.',
            'password.min'      => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'password.confirmed'=> 'Mật khẩu xác nhận không khớp.',
            'name.required'     => 'Tên không được bỏ trống.',
            'password.unique'   => 'Mật khẩu đã được sử dụng.'
        ];
    }
}