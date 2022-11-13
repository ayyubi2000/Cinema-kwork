<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreActorRequest extends FormRequest
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
            'data.nic_name' => 'required',
            'data.name' => 'required',
            'data.address' => 'required',
            'data.birthday' => 'required|array',
            'data.birthday.from' => 'required',
            'data.birthday.to' => 'nullable',
            'data.carrera' => 'required|array',
            'data.carrera.from' => 'required',
            'data.carrera.to' => 'nullable',
            'data.fact' => 'required|array',
            'data.fact.ru' => 'required',
            'data.growth' => 'required',
            'data.url' => 'required',
            'data.photo_url' => 'required',
            'data.country_id' => 'required',
            'data.genre_id' => 'required|array',
            'data.profession_id' => 'required|array',
        ];
    }
}