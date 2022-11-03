<?php

namespace App\Models;

use App\Models\Tag;
use App\Models\User;
use App\Models\Actor;
use App\Models\Movie;
use App\Models\Studio;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @OA\Schema(
 *   description="LatestNew model",
 *   title="LatestNew",
 *   required={},
 *   @OA\Property(type="integer",description="id of LatestNew",title="id",property="id",example="1",readOnly="true"),
 *   @OA\Property(type="string",description="name of LatestNew",title="name",property="name",example="Macbook Pro"),
 *   @OA\Property(type="string",description="sku of LatestNew",title="sku",property="sku",example="MCBPRO2022"),
 *   @OA\Property(type="integer",description="price of LatestNew",title="price",property="price",example="99"),
 *   @OA\Property(type="dateTime",title="created_at",property="created_at",example="2022-07-04T02:41:42.336Z",readOnly="true"),
 *   @OA\Property(type="dateTime",title="updated_at",property="updated_at",example="2022-07-04T02:41:42.336Z",readOnly="true"),
 * )
 *
 *
 * @OA\Schema (
 *   schema="LatestNews",
 *   title="LatestNews list",
 *   @OA\Property(title="data",property="data",type="array",
 *     @OA\Items(type="object",ref="#/components/schemas/LatestNew"),
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
 *      parameter="LatestNew--id",
 *      in="path",
 *      name="LatestNew_id",
 *      required=true,
 *      description="Id of LatestNew",
 *      @OA\Schema(
 *          type="integer",
 *          example="1",
 *      )
 * ),
 */
class LatestNew extends BaseModel
{
    use HasFactory;

    public array $translatable = ['title', 'content'];

    protected $casts = [];

    protected $guarded = ['studios', 'movies', 'actors', 'tags'];

    protected $with = ['user:id,name', 'studios', 'movies', 'actors', 'tags'];

    public function user()
    {
        return $this->belongsTo(User::class)->without('roles');
    }

    /**
     * Get all of the posts that are assigned this tag.
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * Get all of the videos that are assigned this tag.
     */
    public function actors()
    {
        return $this->belongsToMany(Actor::class)->without(['genres', 'professions']);
    }

    /**
     * Get all of the videos that are assigned this tag.
     */
    public function movies()
    {
        return $this->belongsToMany(Movie::class)->without(['studios', 'genres', 'actors']);
    }

    public function studios()
    {
        return $this->belongsToMany(Studio::class)->without(['country', 'genres']);
    }

    public function scopeFilter($query, $data)
    {
        if (isset($data['status'])) {
            $query->whereStatus($data['status']);
        }

        if (isset($data['tags'])) {
            $query->whereHas(
                'tags', function ($q) use ($data) {
                    $q->where('name', $data['tags']);
                }
            );
        }

        if (isset($data['studios'])) {
            $query->whereHas(
                'studios', function ($q) use ($data) {
                    $q->where('studios.id', $data['studios']);
                }
            );
        }

        if (isset($data['actors'])) {
            $query->whereHas(
                'actors', function ($q) use ($data) {
                    $q->where('actors.id', $data['actors']);
                }
            );
        }

        if (isset($data['movies'])) {
            $query->whereHas(
                'movies', function ($q) use ($data) {
                    $q->where('movies.id', $data['movies']);
                }
            );
        }
        return $query;
    }
}