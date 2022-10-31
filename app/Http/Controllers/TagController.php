<?php
namespace App\Http\Controllers;

use Throwable;
use App\Models\Tag;
use App\Services\TagService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class TagControllerController
 * @package  App\Http\Controllers
 */
class TagController extends Controller
{
    private TagService $service;

    public function __construct(TagService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request): LengthAwarePaginator|Collection
    {
        return $this->service->paginatedList($request->all());
    }


    public function store(StoreTagRequest $request): array |Builder|Collection|Tag
    {
        return $this->service->createModel($request->validated('data'));

    }


    public function show($crudgeneratorId): array |Builder|Collection|Tag
    {
        return $this->service->getModelById($crudgeneratorId);
    }


    public function update(UpdateTagRequest $request, int $crudgeneratorId): array |Tag|Collection|Builder
    {
        return $this->service->updateModel($request->validated('data'), $crudgeneratorId);

    }


    public function destroy(int $crudgeneratorId): array |Builder|Collection|Tag
    {
        return $this->service->deleteModel($crudgeneratorId);
    }
}