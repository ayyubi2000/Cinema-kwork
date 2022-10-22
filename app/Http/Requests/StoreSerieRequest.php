<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSerieRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'data.type' => 'required',
            'data.title' => 'required|array',
            'data.title.ru' => 'required',
            'data.date' => 'required',
            'data.movie_id' => 'required|numeric',
        ];
    }
}