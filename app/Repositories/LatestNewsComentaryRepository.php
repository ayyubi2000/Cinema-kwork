<?php

namespace App\Repositories;

use App\Models\LatestNewsComentary;

class LatestNewsComentaryRepository extends BaseRepository
{
    public function __construct(LatestNewsComentary $model)
    {
        parent::__construct($model);
    }
}