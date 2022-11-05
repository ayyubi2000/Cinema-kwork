<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\PostComentaryRepository;


class PostComentaryService extends BaseService
{
    public function __construct(PostComentaryRepository $repository)
    {
        $this->repository = $repository;
    }


    public function createModel($data): array |Collection|Builder|Model|null
    {
        $data['user_id'] = Auth::user()->id;
        if (Auth::user()->roles[0]->role_code != 'new_user') {
            $data['status'] = 1;
        }
        return $this->repository->create($data);
    }

    public function updateModel($data, $id): array |Collection|Builder|Model|null
    {
        if (Auth::user()->roles[0]->role_code == 'new_user') {
            $data['status'] = 0;
        }
        return $this->repository->update($data, $id);
    }

}