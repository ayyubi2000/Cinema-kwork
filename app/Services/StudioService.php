<?php

namespace App\Services;

use App\Repositories\StudioRepository;


class StudioService extends BaseService
{
    public function __construct(StudioRepository $repository)
    {
        $this->repository = $repository;
    }

}