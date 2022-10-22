<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'birthday' => ['required'],
            'avatar_url' => ['required'],
            'password' => ['required', 'min:6'],
            'email' => ['nullable', 'numeric'],
            'roles' => ['array', 'required'],
            'roles.*.role_code' => ['required', 'string'],
            'roles.*.status' => ['required', 'boolean']
        ];
    }
}