<?php

namespace App\Services;

use Throwable;
use App\Models\Tag;
use App\Repositories\TagRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\LatestNewRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;


class LatestNewService extends BaseService
{
    private $tagRepository;
    public function __construct(LatestNewRepository $repository, TagRepository $tagRepository)
    {
        $this->repository = $repository;
        $this->tagRepository = $tagRepository;
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

        if (Auth::user()->roles[0]->role_code != 'user' || Auth::user()->roles[0]->role_code != 'new_user') {
            $data['status'] = 1;
        }
        return $this->repository->create($data);
    }

    public function updateModel($data, $id): array |Collection|Builder|Model|null
    {
        isset($data['tags']['new']) ? $data['tags'] = $this->createNewTag($data) : $data['tags'] = $data['tags']['id'];

        if (Auth::user()->roles[0]->role_code == 'user' || Auth::user()->roles[0]->role_code == 'new_user') {
            $data['status'] = 0;
        }
        return $this->repository->update($data, $id);
    }

}