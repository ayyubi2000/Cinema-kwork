<?php

namespace App\Services;

use App\Repositories\MovieRepository;


class MovieService extends BaseService
{
    public function __construct(MovieRepository $repository)
    {
        $this->repository = $repository;
    }

}