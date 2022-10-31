<?php

namespace App\Services;

use App\Repositories\ActorRepository;


class ActorService extends BaseService
{
    public function __construct(ActorRepository $repository)
    {
        $this->repository = $repository;
    }

}