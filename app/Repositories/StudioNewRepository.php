<?php

namespace App\Repositories;

use App\Models\StudioNew;

class StudioNewRepository extends BaseRepository
{
    public function __construct(StudioNew $model)
    {
        parent::__construct($model);
    }
}