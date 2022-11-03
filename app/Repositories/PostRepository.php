<?php

namespace App\Repositories;

use App\Models\Post;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class PostRepository extends BaseRepository
{
    public function __construct(Post $model)
    {
        parent::__construct($model);
    }


    public function create($data): array |Collection|Builder|BaseModel|null
    {
        $model = $this->getBaseModel();
        $model->fill($data);
        $model->save();

        if (isset($data['tags'])) {
            foreach ($data['tags'] as $tag) {
                $model->tags()->attach(['tags' => $tag]);
            }
        }

        return $model;
    }

    public function update($data, $id): BaseModel|array |Collection|Builder|null
    {
        $model = $this->findById($id);
        $model->fill($data);
        $model->save();

        if (isset($data['tags'])) {
            $model->tags()->detach();
            foreach ($data['tags'] as $tag) {
                $model->tags()->attach(['tags' => $tag]);
            }
        }

        return $model;
    }
}