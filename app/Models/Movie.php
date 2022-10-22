<?php

namespace App\Models;

use App\Models\Genre;
use App\Models\Studio;
use App\Models\Country;
use App\Models\Category;
use App\Models\MovieNew;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @OA\Schema(
 *   description="Movie model",
 *   title="Movie",
 *   required={},
 *   @OA\Property(type="integer",description="id of Movie",title="id",property="id",example="1",readOnly="true"),
 *   @OA\Property(type="string",description="name of Movie",title="name",property="name",example="Macbook Pro"),
 *   @OA\Property(type="string",description="sku of Movie",title="sku",property="sku",example="MCBPRO2022"),
 *   @OA\Property(type="integer",description="price of Movie",title="price",property="price",example="99"),
 *   @OA\Property(type="dateTime",title="created_at",property="created_at",example="2022-07-04T02:41:42.336Z",readOnly="true"),
 *   @OA\Property(type="dateTime",title="updated_at",property="updated_at",example="2022-07-04T02:41:42.336Z",readOnly="true"),
 * )
 *
 *
 *
 *
 *
 * @OA\Schema (
 *   schema="Movies",
 *   title="Movies list",
 *   @OA\Property(title="data",property="data",type="array",
 *     @OA\Items(type="object",ref="#/components/schemas/Movie"),
 *   ),
 *   @OA\Property(type="string", title="first_page_url",property="first_page_url",example="http://localhost:8080/api/merchant-customers?page=1"),
 *   @OA\Property(type="string", title="last_page_url",property="last_page_url",example="http://localhost:8080/api/merchant-customers?page=3"),
 *   @OA\Property(type="string", title="prev_page_url",property="prev_page_url",example="null"),
 *   @OA\Property(type="string", title="next_page_url",property="next_page_url",example="http://localhost:8080/api/merchant-customers?page=2"),
 *   @OA\Property(type="integer", title="current_page",property="current_page",example="1"),
 *   @OA\Property(type="integer", title="from",property="from",example="1"),
 *   @OA\Property(type="integer", title="last_page",property="last_page",example="3"),
 *   @OA\Property(type="string", title="path",property="path",example="http://localhost:8080/api/merchant-customers"),
 *   @OA\Property(type="integer", title="per_page",property="per_page",example="1"),
 *   @OA\Property(type="integer", title="total",property="total",example="3"),
 *   @OA\Property(title="links",property="links",type="array",
 *     @OA\Items(type="object",
 *          @OA\Property(type="string",title="url",property="url",example="http://localhost:8080/api/merchant-customers?page=2"),
 *          @OA\Property(type="string",title="label",property="label",example="1"),
 *          @OA\Property(type="bool",title="active",property="active",example="true"),
 *      ),
 *   )
 * )
 *
 * @OA\Parameter(
 *      parameter="Movie--id",
 *      in="path",
 *      name="Movie_id",
 *      required=true,
 *      description="Id of Movie",
 *      @OA\Schema(
 *          type="integer",
 *          example="1",
 *      )
 * ),
 */
class Movie extends BaseModel
{
    use HasFactory;

    protected $with = ['studios', 'genres'];
    protected $guarded = ['studio_id', 'genre_id'];
    public array $translatable = ['title', 'world_premiere'];

    protected $casts = [];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function studios()
    {
        return $this->belongsToMany(Studio::class)->without(['studio_news', 'country', 'genres']);
    }

    public function movieNews()
    {
        return $this->hasMany(MovieNew::class);
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }
}