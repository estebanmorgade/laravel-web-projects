<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SaveUserRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => ['required','email',Rule::unique('users')->ignore($this->route('user'))],
            'role' => 'required|string|in:admin,superadmin,user',
            'password' => [$this->route('user') ? 'nullable' : 'required','min:8']//,'confirmed']
        ];
    }

    /*public function messages()
    {
        return [
            'name.required' => 'Name field is required',
            'name.string' => 'Name must be a string',
            'name.max' => 'Name too long',
            'email.required' => 'Email field is required',
            'email.email' => 'Email must be type email',
            'role.required' => 'Role field is required',
            'role.string' => 'Role must be a string',
            'role.in' => 'Role must be user, admin or superadmin',
            'password.required' => 'Password field is required'
        ]
    }*/
}
