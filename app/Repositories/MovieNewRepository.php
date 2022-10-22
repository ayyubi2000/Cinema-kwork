<?php

namespace App\Repositories;

use App\Models\MovieNew;

class MovieNewRepository extends BaseRepository
{
    public function __construct(MovieNew $model)
    {
        parent::__construct($model);
    }
}