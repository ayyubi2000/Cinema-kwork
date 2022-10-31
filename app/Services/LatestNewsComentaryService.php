<?php

namespace App\Services;

use App\Repositories\LatestNewsComentaryRepository;


class LatestNewsComentaryService extends BaseService
{
    public function __construct(LatestNewsComentaryRepository $repository)
    {
        $this->repository = $repository;
    }

}