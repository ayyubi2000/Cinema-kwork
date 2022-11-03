<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLatestNewsComentaryRequest extends FormRequest
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
            'data.content' => 'required',
            'data.user_id' => 'required|numeric',
            'data.latest_new_id' => 'required|numeric',
            'data.answear_id' => 'nullable|numeric',
            'data.status' => 'nullable',
            'data.validation_message' => 'nullable',
        ];
    }
}