<?php

namespace App\Services;

use App\Repositories\MovieNewRepository;


class MovieNewService extends BaseService
{
    public function __construct(MovieNewRepository $repository)
    {
        $this->repository = $repository;
    }

}