<?php

namespace App\Services;

use App\Repositories\MovieRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;


class MovieService extends BaseService
{
    public function __construct(MovieRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param $id
     * @return Model|Model[]|Builder|Builder[]|Collection|null
     * @throws Throwable
     */
    public function getModelById($id, $relations = []): Model|array |Collection|Builder|null
    {
        $movie = $this->repository->findById($id, $relations);
        return $movie;
    }
}