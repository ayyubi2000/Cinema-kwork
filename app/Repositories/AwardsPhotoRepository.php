<?php

namespace App\Repositories;

use App\Models\AwardsPhoto;

class AwardsPhotoRepository extends BaseRepository
{
    public function __construct(AwardsPhoto $model)
    {
        parent::__construct($model);
    }
}