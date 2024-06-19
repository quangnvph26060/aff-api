<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdminRequest extends FormRequest
{
    public function authorize()
    {
       
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:2',
            'city_id' => 'required|integer',
            'district_id' => 'required|integer',
            'wards_id' => 'required|integer',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|regex:/^(\d{10,11})$/',
            'email' => 'required|string|email|max:255|unique:users,email,',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên là bắt buộc.',
            'city_id.required' => 'Thành phố là bắt buộc.',
            'district_id.required' => 'Quận/Huyện là bắt buộc.',
            'wards_id.required' => 'Phường/Xã là bắt buộc.',
            'address.required' => 'Địa chỉ là bắt buộc.',
            'phone.required' => 'Số điện thoại là bắt buộc.',
            'phone.regex' => 'Số điện thoại không hợp lệ.',
            'email.required' => 'Email là bắt buộc.',
            'email.email' => 'Email không hợp lệ.',
            'email.unique' => 'Email đã tồn tại.',
        ];
    }
}
