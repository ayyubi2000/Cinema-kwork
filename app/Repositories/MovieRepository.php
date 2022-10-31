<?php

namespace App\Repositories;

use App\Models\Movie;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class MovieRepository extends BaseRepository
{
    public function __construct(Movie $model)
    {
        parent::__construct($model);
    }

    public function create($data): array |Collection|Builder|BaseModel|null
    {
        $model = $this->getBaseModel();
        $model->fill($data);
        $model->save();
        if (isset($data['studio_id'])) {
            foreach ($data['studio_id'] as $studio) {
                $model->studios()->attach(['studio_id' => $studio]);
            }
        }
        if (isset($data['genre_id'])) {
            foreach ($data['genre_id'] as $genre) {
                $model->genres()->attach(['genre_id' => $genre]);
            }
        }
        if (isset($data['actor_id'])) {
            foreach ($data['actor_id'] as $actor) {
                $model->actors()->attach(['actor_id' => $actor]);
            }
        }

        return $model;
    }

    public function update($data, $id): BaseModel|array |Collection|Builder|null
    {
        $model = $this->findById($id);
        $model->fill($data);
        $model->save();
        if (isset($data['studio_id'])) {
            foreach ($data['studio_id'] as $studio) {
                $model->studios()->sync(['studio_id' => $studio]);
            }
        }
        if (isset($data['genre_id'])) {
            foreach ($data['genre_id'] as $genre) {
                $model->genres()->sync(['genre_id' => $genre]);
            }
        }

        return $model;
    }

}