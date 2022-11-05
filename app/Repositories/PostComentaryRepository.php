<?php

namespace App\Repositories;

use App\Models\PostComentary;

class PostComentaryRepository extends BaseRepository
{
    public function __construct(PostComentary $model)
    {
        parent::__construct($model);
    }
}