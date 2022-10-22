<?php
namespace App\Http\Controllers;

use Throwable;
use App\Models\Movie;
use App\Services\MovieService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class MovieControllerController
 * @package  App\Http\Controllers
 */
class MovieController extends Controller
{
    private MovieService $service;

    public function __construct(MovieService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *  path="/api/movie",
     *  operationId="indexMovie",
     *  tags={"Movies"},
     *  summary="Get list of Movie",
     *  description="Returns list of Movie",
     *  @OA\Response(response=200, description="Successful operation",
     *    @OA\JsonContent(ref="#/components/schemas/Movie"),
     *  ),
     * )
     *
     * Display a listing of Movie.
     * @return LengthAwarePaginator
     * @throws Throwable
     */
    public function index(Request $request): LengthAwarePaginator|Collection
    {
        return $this->service->paginatedList($request->all());
    }

    /**
     * @OA\Post(
     *  operationId="storeMovie",
     *  summary="Insert a new Movie",
     *  description="Insert a new Movie",
     *  tags={"Movies"},
     *  path="/api/movie",
     *  @OA\RequestBody(
     *    description="Movie to create",
     *    required=true,
     *    @OA\MediaType(
     *      mediaType="application/json",
     *      @OA\Schema(
     *      @OA\Property(
     *      title="data",
     *      property="data",
     *      type="object",
     *      ref="#/components/schemas/Movie")
     *     )
     *    )
     *  ),
     *  @OA\Response(response="201",description="Movie created",
     *     @OA\JsonContent(
     *      @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Movie"
     *      ),
     *    ),
     *  ),
     *  @OA\Response(response=422,description="Validation exception"),
     * )
     *
     * @param StoreMovieRequest $request
     * @return array|Builder|Collection|Movie|Builder[]|Movie[]
     * @throws Throwable
     */
    public function store(StoreMovieRequest $request): array |Builder|Collection|Movie
    {
        return $this->service->createModel($request->validated('data'));

    }

    /**
     * @OA\Get(
     *   path="/api/movie/{movie_id}",
     *   summary="Show a Movie from his Id",
     *   description="Show a Movie from his Id",
     *   operationId="showMovie",
     *   tags={"Movies"},
     *   @OA\Parameter(ref="#/components/parameters/Movie--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Movie"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="Movie not found"),
     * )
     *
     * @param $crudgeneratorId
     * @return array|Builder|Collection|Movie
     * @throws Throwable
     */
    public function show($crudgeneratorId): array |Builder|Collection|Movie
    {
        return $this->service->getModelById($crudgeneratorId);
    }

    /**
     * @OA\Patch(
     *   operationId="updateMovie",
     *   summary="Update an existing Movie",
     *   description="Update an existing Movie",
     *   tags={"Movies"},
     *   path="/api/movie/{movie_id}",
     *   @OA\Parameter(ref="#/components/parameters/Movie--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Movie"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="Movie not found"),
     *   @OA\RequestBody(
     *     description="Movie to update",
     *     required=true,
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *        @OA\Property(
     *        title="data",
     *        property="data",
     *        type="object",
     *        ref="#/components/schemas/Movie")
     *      )
     *     )
     *   )
     *
     * )
     *
     * @param UpdateMovieRequest $request
     * @param int $crudgeneratorId
     * @return array|Builder|Builder[]|Collection|Movie|Movie[]
     * @throws Throwable
     */
    public function update(UpdateMovieRequest $request, int $crudgeneratorId): array |Movie|Collection|Builder
    {
        return $this->service->updateModel($request->validated('data'), $crudgeneratorId);

    }

    /**
     * @OA\Delete(
     *  path="/api/movie/{movie_id}",
     *  summary="Delete a Movie",
     *  description="Delete a Movie",
     *  operationId="destroyMovie",
     *  tags={"Movies"},
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Movie"
     *       ),
     *     ),
     *   ),
     *  @OA\Parameter(ref="#/components/parameters/Movie--id"),
     *  @OA\Response(response=204,description="No content"),
     *  @OA\Response(response=404,description="Movie not found"),
     * )
     *
     * @param int $crudgeneratorId
     * @return array|Builder|Builder[]|Collection|Movie|Movie[]
     * @throws Throwable
     */
    public function destroy(int $crudgeneratorId): array |Builder|Collection|Movie
    {
        return $this->service->deleteModel($crudgeneratorId);
    }
}