<?php

namespace App\Repositories;

use App\Models\BaseModel;
use App\Models\LatestNew;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class LatestNewRepository extends BaseRepository
{
    public function __construct(LatestNew $model)
    {
        parent::__construct($model);
    }


    public function create($data): array |Collection|Builder|BaseModel|null
    {
        $model = $this->getBaseModel();
        $model->fill($data);
        $model->save();
        if (isset($data['studios'])) {
            foreach ($data['studios'] as $studio) {
                $model->studios()->attach(['studio_id' => $studio]);
            }
        }
        if (isset($data['tags'])) {
            foreach ($data['tags'] as $tag) {
                $model->tags()->attach(['tags' => $tag]);
            }
        }
        if (isset($data['movies'])) {
            foreach ($data['movies'] as $movie) {
                $model->movies()->attach(['movies' => $movie]);
            }
        }
        if (isset($data['actors'])) {
            foreach ($data['actors'] as $actor) {
                $model->actors()->attach(['actors' => $actor]);
            }
        }

        return $model;
    }

    public function update($data, $id): BaseModel|array |Collection|Builder|null
    {
        $model = $this->findById($id);
        $model->fill($data);
        $model->save();
        if (isset($data['studios'])) {
            $model->studios()->detach();
            foreach ($data['studios'] as $studio) {
                $model->studios()->attach(['studio_id' => $studio]);
            }
        }
        if (isset($data['tags'])) {
            $model->tags()->detach();
            foreach ($data['tags'] as $tag) {
                $model->tags()->attach(['tags' => $tag]);
            }
        }
        if (isset($data['movies'])) {
            $model->movies()->detach();
            foreach ($data['movies'] as $movie) {
                $model->movies()->attach(['movies' => $movie]);
            }
        }
        if (isset($data['actors'])) {
            $model->actors()->detach();
            foreach ($data['actors'] as $actor) {
                $model->actors()->attach(['actors' => $actor]);
            }
        }
        return $model;
    }

}