<?php

namespace App\Repositories;

use App\Models\BaseModel;
use App\Models\Region;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class RegionRepository extends BaseRepository
{
    public function __construct(Region $model)
    {
        parent::__construct($model);
    }

    public function paginatedListOfState(): LengthAwarePaginator
    {
        return parent::query()->whereNotNull('parent_id')->with('region')->paginate();
    }
}