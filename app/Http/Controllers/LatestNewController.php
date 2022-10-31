<?php
namespace App\Http\Controllers;

use Throwable;
use App\Models\LatestNew;
use App\Services\LatestNewService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Requests\StoreLatestNewRequest;
use App\Http\Requests\UpdateLatestNewRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class LatestNewControllerController
 * @package  App\Http\Controllers
 */
class LatestNewController extends Controller
{
    private LatestNewService $service;

    public function __construct(LatestNewService $service)
    {
        $this->service = $service;
    }


    public function index(Request $request): LengthAwarePaginator|Collection
    {
        return $this->service->paginatedList($request->all());
    }


    public function store(StoreLatestNewRequest $request): array |Builder|Collection|LatestNew
    {
        return $this->service->createModel($request->validated('data'));

    }


    public function show($crudgeneratorId): array |Builder|Collection|LatestNew
    {
        return $this->service->getModelById($crudgeneratorId);
    }


    public function update(UpdateLatestNewRequest $request, int $crudgeneratorId): array |LatestNew|Collection|Builder
    {
        return $this->service->updateModel($request->validated('data'), $crudgeneratorId);

    }


    public function destroy(int $crudgeneratorId): array |Builder|Collection|LatestNew
    {
        return $this->service->deleteModel($crudgeneratorId);
    }

}