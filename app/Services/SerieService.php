<?php

namespace App\Services;

use App\Repositories\SerieRepository;


class SerieService extends BaseService
{
    public function __construct(SerieRepository $repository)
    {
        $this->repository = $repository;
    }

}