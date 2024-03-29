<?php

namespace App\Repositories;

use App\Constants\Pagination;
use App\Interfaces\IBaseRepository;
use App\Models\BaseModel;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Throwable;
use Illuminate\Support\Facades\Auth;

class BaseRepository implements IBaseRepository
{

    protected BaseModel $modelClass;

    /**
     * @param BaseModel $modelClass
     */
    public function __construct(BaseModel $modelClass)
    {
        $this->modelClass = $modelClass;
    }

    /**
     * @throws Throwable
     */
    protected function query(): Builder|BaseModel
    {
        /** @var BaseModel $class */
        $query = $this->getBaseModel()->query();

        if (!is_null(auth()->user()) && auth()->user() && method_exists($this->getBaseModel(), 'scopeRole'))
            $query->role(auth()->user());

        return $query->orderByDesc('id');
    }

    /**
     * @return BaseModel
     * @throws Throwable
     */
    protected function getBaseModel(): BaseModel
    {
        return $this->modelClass;
    }

    /**
     * @throws Throwable
     */
    public function paginatedList($data = [], array |string $with = null): LengthAwarePaginator
    {
        $query = $this->query();
        if (method_exists($this->getBaseModel(), 'scopeFilter'))
            $query->filter($data);

        if (!is_null($with))
            $query->with($with);

        return $query->paginate(Pagination::PerPage);
    }

    public function getAllList($data = [], array |string $with = null): Collection
    {
        $query = $this->query();
        if (method_exists($this->getBaseModel(), 'scopeFilter'))
            $query->filter($data);

        if (!is_null($with))
            $query->with($with);

        return $query->get();
    }

    /**
     * @param $data
     * @return BaseModel|BaseModel[]|Builder|Builder[]|Collection|null
     * @throws Throwable
     */
    public function create($data): array |Collection|Builder|BaseModel|null
    {
        $model = $this->getBaseModel();
        foreach ($data as $item => $value) {
            if (!in_array($item, $model->translatable)) {
                $model->{ $item} = $value;
                continue;
            }
            if (is_array($value)) {
                foreach ($value as $name => $itemValue) {
                    app()->setLocale($name);
                    $model->{ $item} = $itemValue;
                }
            } else {
                $model->{ $item} = $value;
            }
        }
        $model->save();
        return $model;
    }

    /**
     * @param $data
     * @param $id
     * @return BaseModel|BaseModel[]|Builder|Builder[]|Collection|null
     * @throws Throwable
     */
    public function update($data, $id): BaseModel|array |Collection|Builder|null
    {
        $model = $this->findById($id);
        foreach ($data as $item => $value) {
            if (!in_array($item, $model->translatable)) {
                $model->{ $item} = $value;
                continue;
            }
            if (is_array($value)) {
                foreach ($value as $name => $itemValue) {
                    app()->setLocale($name);
                    $model->{ $item} = $itemValue;
                }
            } else {
                $model->{ $item} = $value;
            }
        }
        $model->save();
        return $model;
    }

    /**
     * @param $id
     * @return BaseModel|BaseModel[]|Builder|Builder[]|Collection|null
     * @throws Throwable
     */
    public function findById($id, $relations = []): BaseModel|array |Collection|Builder|null
    {
        if (!empty($relations))
            return $this->query()->with($relations)->findOrFail($id);
        return $this->query()->findOrFail($id);
    }

    /**
     * @param $id
     * @return array|Builder|Builder[]|Collection|BaseModel|BaseModel[]
     * @throws Throwable
     */
    public function delete($id): array |Builder|Collection|BaseModel
    {
        $model = $this->findById($id);
        $model->delete();
        return $model;
    }
}