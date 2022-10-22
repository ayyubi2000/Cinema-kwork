<?php

namespace App\Repositories;

use App\Models\Serie;

class SerieRepository extends BaseRepository
{
    public function __construct(Serie $model)
    {
        parent::__construct($model);
    }
}