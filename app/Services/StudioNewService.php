<?php

namespace App\Services;

use App\Repositories\StudioNewRepository;


class StudioNewService extends BaseService
{
    public function __construct(StudioNewRepository $repository)
    {
        $this->repository = $repository;
    }

}