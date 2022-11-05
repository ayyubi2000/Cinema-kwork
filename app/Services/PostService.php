<?php

namespace App\Services;

use App\Models\Tag;
use App\Repositories\PostRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;


class PostService extends BaseService
{
    public function __construct(PostRepository $repository)
    {
        $this->repository = $repository;
    }


    private function createNewTag($data)
    {
        foreach ($data['tags']['new'] as $tag) {
            array_push($data['tags']['id'], Tag::create(['name' => $tag])->id);
        }
        return $data['tags']['id'];
    }

    public function createModel($data): array |Collection|Builder|Model|null
    {
        $data['user_id'] = Auth::user()->id;

        isset($data['tags']['new']) ? $data['tags'] = $this->createNewTag($data) : $data['tags'] = $data['tags']['id'];

        if (Auth::user()->roles[0]->role_code != 'new_user') {
            $data['status'] = 1;
        }
        return $this->repository->create($data);
    }

    public function updateModel($data, $id): array |Collection|Builder|Model|null
    {
        isset($data['tags']['new']) ? $data['tags'] = $this->createNewTag($data) : $data['tags'] = $data['tags']['id'];

        if (Auth::user()->roles[0]->role_code == 'new_user') {
            $data['status'] = 0;
        }
        return $this->repository->update($data, $id);
    }

}