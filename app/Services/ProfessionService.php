<?php

namespace App\Services;

use App\Repositories\ProfessionRepository;


class ProfessionService extends BaseService
{
    public function __construct(ProfessionRepository $repository)
    {
        $this->repository = $repository;
    }

}