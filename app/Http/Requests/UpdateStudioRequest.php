<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudioRequest extends FormRequest
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
            'data.title' => 'required',
            'data.photo_url' => 'required',
            'data.establition_date' => 'required|array',
            'data.establition_date.ru' => 'required',
            'data.founders' => 'required',
            'data.country_id' => 'required',
            'data.employees_amount' => 'required',
            'data.capitalization' => 'required',
            'data.profit' => 'required',
            'data.web_site_url' => 'required',
            'data.history' => 'required',
            'data.genre_id' => 'required',
        ];
    }
}