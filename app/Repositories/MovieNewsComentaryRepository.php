<?php

namespace App\Repositories;

use App\Models\MovieNewsComentary;

class MovieNewsComentaryRepository extends BaseRepository
{
    public function __construct(MovieNewsComentary $model)
    {
        parent::__construct($model);
    }
}