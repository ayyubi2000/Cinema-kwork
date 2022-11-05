<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostComentaryRequest extends FormRequest
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
            'data.content' => 'nullable',
            'data.user_id' => 'nullable|numeric',
            'data.post_id' => 'nullable|numeric',
            'data.answear_id' => 'nullable|numeric',
            'data.status' => 'nullable',
            'data.validation_message' => 'nullable',
        ];
    }
}