<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMovieRequest extends FormRequest
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
            'data.title' => 'required|array',
            'data.title.ru' => 'required',
            'data.photo_url' => 'required',
            'data.top' => 'required',
            'data.type' => 'required',
            'data.age_limit' => 'required',
            'data.production_year' => 'required',
            'data.slogan' => 'required',
            'data.director' => 'required',
            'data.scenario' => 'required',
            'data.producer' => 'required',
            'data.operator' => 'required',
            'data.composer' => 'required',
            'data.painter' => 'required',
            'data.assembly' => 'required',
            'data.world_premiere' => 'required|array',
            'data.world_premiere.ru' => 'required',
            'data.mpaa_rating' => 'required',
            'data.duration' => 'required',
            'data.country_id' => 'required',
            'data.category_id' => 'required',
            'data.studio_id' => 'required|array',
            'data.genre_id' => 'required|array',
            'data.actor_id' => 'required|array',
        ];
    }
}