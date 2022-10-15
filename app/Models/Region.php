<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @OA\Schema(
 *   description="Region model",
 *   title="Region",
 *   required={},
 *   @OA\Property(type="integer",description="id of Region",title="id",property="id",example="1",readOnly="true"),
 *   @OA\Property(type="string",description="name of Region",title="name",property="name",example="Macbook Pro"),
 * )
 *
 *
 *
 *
 *
 * @OA\Schema (
 *   schema="Regions",
 *   title="Regions list",
 *   @OA\Property(title="data",property="data",type="array",
 *     @OA\Items(type="object",ref="#/components/schemas/Region"),
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
 *      parameter="Region--id",
 *      in="path",
 *      name="Region_id",
 *      required=true,
 *      description="Id of Region",
 *      @OA\Schema(
 *          type="integer",
 *          example="1",
 *      )
 * ),
 */
class Region extends BaseModel
{
    use HasFactory;

    protected $table = 'regions';
    public array $translatable = ['name'];


    public function museums()
    {
//        return $this->hasMany(Museum::class)->with('details'); //TODO add details
        return $this->hasMany(Museum::class)->with('museumDetail');
    }

    public function scopeFilter($query, $data)
    {
        
        if(isset($data['filter'])) $query->has('museums');
        return isset($data['parent_id']) ? ($data['parent_id'] ==0 ? $query->whereNotNull('parent_id') : $query->where('parent_id', $data['parent_id']))  : $query->whereNull('parent_id');
    }
    
    public function region()
    {
        return $this->belongsTo(self::class, 'id' , 'parent_id')->with('museums');
    }
    public function states()
    {
        return $this->hasMany(self::class,'parent_id', 'id');
    }
    protected $casts = [];
}
