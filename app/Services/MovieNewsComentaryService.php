<?php

namespace App\Services;

use App\Repositories\MovieNewsComentaryRepository;


class MovieNewsComentaryService extends BaseService
{
    public function __construct(MovieNewsComentaryRepository $repository)
    {
        $this->repository = $repository;
    }

}