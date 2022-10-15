<?php

namespace App\Services;

use App\Repositories\RegionRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;


class RegionService extends BaseService
{
    public function __construct(RegionRepository $repository)
    {
        $this->repository = $repository;
    }

    public function paginatedListOfState(): LengthAwarePaginator
    {
        return $this->repository->paginatedListOfState();
    }

    public function getModelById($id): Model|array |Collection|Builder|null
    {
        return $this->getRepository()->findById($id);
    }
}