<?php

namespace App\Repositories;

use App\Models\Studio;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class StudioRepository extends BaseRepository
{
    public function __construct(Studio $model)
    {
        parent::__construct($model);
    }

    public function create($data): array |Collection|Builder|BaseModel|null
    {
        $model = $this->getBaseModel();
        $model->fill($data);
        $model->save();
        if (isset($data['genre_id'])) {
            foreach ($data['genre_id'] as $genre) {
                $model->genres()->attach(['genre_id' => $genre]);
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
            foreach ($data['genre_id'] as $genre) {
                $model->genres()->attach(['genre_id' => $genre]);
            }
        }

        return $model;
    }
}