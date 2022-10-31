<?php

namespace App\Services;

use Throwable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\LatestNewRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;


class LatestNewService extends BaseService
{
    public function __construct(LatestNewRepository $repository)
    {
        $this->repository = $repository;
    }

    public function createModel($data): array |Collection|Builder|Model|null
    {
        $data['user_id'] = Auth::user()->id;
        return $this->repository->create($data);
    }

    public function updateModel($data, $id): array |Collection|Builder|Model|null
    {
        $data['user_id'] = Auth::user()->id;
        return $this->repository->update($data, $id);
    }

}