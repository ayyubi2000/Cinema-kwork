<?php

namespace App\Repositories;

use App\Models\Profession;

class ProfessionRepository extends BaseRepository
{
    public function __construct(Profession $model)
    {
        parent::__construct($model);
    }
}