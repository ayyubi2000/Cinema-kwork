<?php

namespace App\Services;

use App\Repositories\RatingRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;


class RatingService extends BaseService
{
    public function __construct(RatingRepository $repository)
    {
        $this->repository = $repository;
    }


}