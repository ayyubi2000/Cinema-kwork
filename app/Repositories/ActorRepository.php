<?php

namespace App\Repositories;

use App\Models\Actor;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ActorRepository extends BaseRepository
{
    public function __construct(Actor $model)
    {
        parent::__construct($model);
    }


    public function create($data): array |Collection|Builder|BaseModel|null
    {
        $model = $this->getBaseModel();
        $model->fill($data);
        $model->save();
        if (isset($data['genre_id'])) {
            foreach ($data['genre_id'] as $ganre) {
                $model->genres()->attach(['genre_id' => $ganre]);
            }
        }
        if (isset($data['profession_id'])) {
            foreach ($data['profession_id'] as $profession) {
                $model->professions()->attach(['profession_id' => $profession]);
            }
        }

        return $model;
    }

    public function update($data, $id): BaseModel|array |Collection|Builder|null
    {
        $model = $this->findById($id);
        $model->fill($data);
        $model->save();
        if (isset($data['genre_id'])) {
            $model->genres()->detach();
            foreach ($data['genre_id'] as $ganre) {
                $model->genres()->attach(['genre_id' => $ganre]);
            }
        }
        if (isset($data['profession_id'])) {
            $model->professions()->detach();
            foreach ($data['profession_id'] as $profession) {
                $model->professions()->attach(['profession_id' => $profession]);
            }
        }
        return $model;
    }
}