<?php

namespace App\Services;

use App\Repositories\AwardsPhotoRepository;


class AwardsPhotoService extends BaseService
{
    public function __construct(AwardsPhotoRepository $repository)
    {
        $this->repository = $repository;
    }

}