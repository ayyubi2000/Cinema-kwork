<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLatestNewsComentaryRequest extends FormRequest
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
            'data.content' => 'required',
            'data.user_id' => 'required|numeric',
            'data.movie_news_id' => 'required|numeric',
            'data.parent_id' => 'nullable|numeric',
            'data.studios' => 'nullable|array',
        ];
    }
}