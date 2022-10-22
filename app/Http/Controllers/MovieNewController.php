<?php
namespace App\Http\Controllers;

use Throwable;
use App\Models\MovieNew;
use App\Services\MovieNewService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Requests\StoreMovieNewRequest;
use App\Http\Requests\UpdateMovieNewRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class MovieNewControllerController
 * @package  App\Http\Controllers
 */
class MovieNewController extends Controller
{
    private MovieNewService $service;

    public function __construct(MovieNewService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *  path="/api/movie-new",
     *  operationId="indexMovieNew",
     *  tags={"MovieNews"},
     *  summary="Get list of MovieNew",
     *  description="Returns list of MovieNew",
     *  @OA\Response(response=200, description="Successful operation",
     *    @OA\JsonContent(ref="#/components/schemas/MovieNew"),
     *  ),
     * )
     *
     * Display a listing of MovieNew.
     * @return LengthAwarePaginator
     * @throws Throwable
     */
    public function index(Request $request): LengthAwarePaginator|Collection
    {
        return $this->service->paginatedList($request->all());
    }

    /**
     * @OA\Post(
     *  operationId="storeMovieNew",
     *  summary="Insert a new MovieNew",
     *  description="Insert a new MovieNew",
     *  tags={"MovieNews"},
     *  path="/api/movie-new",
     *  @OA\RequestBody(
     *    description="MovieNew to create",
     *    required=true,
     *    @OA\MediaType(
     *      mediaType="application/json",
     *      @OA\Schema(
     *      @OA\Property(
     *      title="data",
     *      property="data",
     *      type="object",
     *      ref="#/components/schemas/MovieNew")
     *     )
     *    )
     *  ),
     *  @OA\Response(response="201",description="MovieNew created",
     *     @OA\JsonContent(
     *      @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/MovieNew"
     *      ),
     *    ),
     *  ),
     *  @OA\Response(response=422,description="Validation exception"),
     * )
     *
     * @param StoreMovieNewRequest $request
     * @return array|Builder|Collection|MovieNew|Builder[]|MovieNew[]
     * @throws Throwable
     */
    public function store(StoreMovieNewRequest $request): array |Builder|Collection|MovieNew
    {
        return $this->service->createModel($request->validated('data'));

    }

    /**
     * @OA\Get(
     *   path="/api/movie-new/{movienew_id}",
     *   summary="Show a MovieNew from his Id",
     *   description="Show a MovieNew from his Id",
     *   operationId="showMovieNew",
     *   tags={"MovieNews"},
     *   @OA\Parameter(ref="#/components/parameters/MovieNew--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/MovieNew"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="MovieNew not found"),
     * )
     *
     * @param $crudgeneratorId
     * @return array|Builder|Collection|MovieNew
     * @throws Throwable
     */
    public function show($crudgeneratorId): array |Builder|Collection|MovieNew
    {
        return $this->service->getModelById($crudgeneratorId, ['movie:id,title']);
    }

    /**
     * @OA\Patch(
     *   operationId="updateMovieNew",
     *   summary="Update an existing MovieNew",
     *   description="Update an existing MovieNew",
     *   tags={"MovieNews"},
     *   path="/api/movie-new/{movienew_id}",
     *   @OA\Parameter(ref="#/components/parameters/MovieNew--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/MovieNew"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="MovieNew not found"),
     *   @OA\RequestBody(
     *     description="MovieNew to update",
     *     required=true,
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *        @OA\Property(
     *        title="data",
     *        property="data",
     *        type="object",
     *        ref="#/components/schemas/MovieNew")
     *      )
     *     )
     *   )
     *
     * )
     *
     * @param UpdateMovieNewRequest $request
     * @param int $crudgeneratorId
     * @return array|Builder|Builder[]|Collection|MovieNew|MovieNew[]
     * @throws Throwable
     */
    public function update(UpdateMovieNewRequest $request, int $crudgeneratorId): array |MovieNew|Collection|Builder
    {
        return $this->service->updateModel($request->validated('data'), $crudgeneratorId);

    }

    /**
     * @OA\Delete(
     *  path="/api/movie-new/{movienew_id}",
     *  summary="Delete a MovieNew",
     *  description="Delete a MovieNew",
     *  operationId="destroyMovieNew",
     *  tags={"MovieNews"},
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/MovieNew"
     *       ),
     *     ),
     *   ),
     *  @OA\Parameter(ref="#/components/parameters/MovieNew--id"),
     *  @OA\Response(response=204,description="No content"),
     *  @OA\Response(response=404,description="MovieNew not found"),
     * )
     *
     * @param int $crudgeneratorId
     * @return array|Builder|Builder[]|Collection|MovieNew|MovieNew[]
     * @throws Throwable
     */
    public function destroy(int $crudgeneratorId): array |Builder|Collection|MovieNew
    {
        return $this->service->deleteModel($crudgeneratorId);
    }
}