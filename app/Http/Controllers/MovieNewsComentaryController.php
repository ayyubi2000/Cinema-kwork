<?php
namespace App\Http\Controllers;

use Throwable;
use App\Models\MovieNewsComentary;
use App\Services\MovieNewsComentaryService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Requests\StoreMovieNewsComentaryRequest;
use App\Http\Requests\UpdateMovieNewsComentaryRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class MovieNewsComentaryControllerController
 * @package  App\Http\Controllers
 */
class MovieNewsComentaryController extends Controller
{
    private MovieNewsComentaryService $service;

    public function __construct(MovieNewsComentaryService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *  path="/api/movie-new-comentary",
     *  operationId="indexMovieNewsComentary",
     *  tags={"MovieNewsComentarys"},
     *  summary="Get list of MovieNewsComentary",
     *  description="Returns list of MovieNewsComentary",
     *  @OA\Response(response=200, description="Successful operation",
     *    @OA\JsonContent(ref="#/components/schemas/MovieNewsComentary"),
     *  ),
     * )
     *
     * Display a listing of MovieNewsComentary.
     * @return LengthAwarePaginator
     * @throws Throwable
     */
    public function index(Request $request): LengthAwarePaginator|Collection
    {
        return $this->service->paginatedList($request->all());
    }

    /**
     * @OA\Post(
     *  operationId="storeMovieNewsComentary",
     *  summary="Insert a new MovieNewsComentary",
     *  description="Insert a new MovieNewsComentary",
     *  tags={"MovieNewsComentarys"},
     *  path="/api/movie-new-comentary",
     *  @OA\RequestBody(
     *    description="MovieNewsComentary to create",
     *    required=true,
     *    @OA\MediaType(
     *      mediaType="application/json",
     *      @OA\Schema(
     *      @OA\Property(
     *      title="data",
     *      property="data",
     *      type="object",
     *      ref="#/components/schemas/MovieNewsComentary")
     *     )
     *    )
     *  ),
     *  @OA\Response(response="201",description="MovieNewsComentary created",
     *     @OA\JsonContent(
     *      @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/MovieNewsComentary"
     *      ),
     *    ),
     *  ),
     *  @OA\Response(response=422,description="Validation exception"),
     * )
     *
     * @param StoreMovieNewsComentaryRequest $request
     * @return array|Builder|Collection|MovieNewsComentary|Builder[]|MovieNewsComentary[]
     * @throws Throwable
     */
    public function store(StoreMovieNewsComentaryRequest $request): array |Builder|Collection|MovieNewsComentary
    {
        return $this->service->createModel($request->validated('data'));

    }

    /**
     * @OA\Get(
     *   path="/api/movie-new-comentary/{movienewscomentary_id}",
     *   summary="Show a MovieNewsComentary from his Id",
     *   description="Show a MovieNewsComentary from his Id",
     *   operationId="showMovieNewsComentary",
     *   tags={"MovieNewsComentarys"},
     *   @OA\Parameter(ref="#/components/parameters/MovieNewsComentary--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/MovieNewsComentary"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="MovieNewsComentary not found"),
     * )
     *
     * @param $crudgeneratorId
     * @return array|Builder|Collection|MovieNewsComentary
     * @throws Throwable
     */
    public function show($crudgeneratorId): array |Builder|Collection|MovieNewsComentary
    {
        return $this->service->getModelById($crudgeneratorId);
    }

    /**
     * @OA\Patch(
     *   operationId="updateMovieNewsComentary",
     *   summary="Update an existing MovieNewsComentary",
     *   description="Update an existing MovieNewsComentary",
     *   tags={"MovieNewsComentarys"},
     *   path="/api/movie-new-comentary/{movienewscomentary_id}",
     *   @OA\Parameter(ref="#/components/parameters/MovieNewsComentary--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/MovieNewsComentary"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="MovieNewsComentary not found"),
     *   @OA\RequestBody(
     *     description="MovieNewsComentary to update",
     *     required=true,
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *        @OA\Property(
     *        title="data",
     *        property="data",
     *        type="object",
     *        ref="#/components/schemas/MovieNewsComentary")
     *      )
     *     )
     *   )
     *
     * )
     *
     * @param UpdateMovieNewsComentaryRequest $request
     * @param int $crudgeneratorId
     * @return array|Builder|Builder[]|Collection|MovieNewsComentary|MovieNewsComentary[]
     * @throws Throwable
     */
    public function update(UpdateMovieNewsComentaryRequest $request, int $crudgeneratorId): array |MovieNewsComentary|Collection|Builder
    {
        return $this->service->updateModel($request->validated('data'), $crudgeneratorId);

    }

    /**
     * @OA\Delete(
     *  path="/api/movie-new-comentary/{movienewscomentary_id}",
     *  summary="Delete a MovieNewsComentary",
     *  description="Delete a MovieNewsComentary",
     *  operationId="destroyMovieNewsComentary",
     *  tags={"MovieNewsComentarys"},
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/MovieNewsComentary"
     *       ),
     *     ),
     *   ),
     *  @OA\Parameter(ref="#/components/parameters/MovieNewsComentary--id"),
     *  @OA\Response(response=204,description="No content"),
     *  @OA\Response(response=404,description="MovieNewsComentary not found"),
     * )
     *
     * @param int $crudgeneratorId
     * @return array|Builder|Builder[]|Collection|MovieNewsComentary|MovieNewsComentary[]
     * @throws Throwable
     */
    public function destroy(int $crudgeneratorId): array |Builder|Collection|MovieNewsComentary
    {
        return $this->service->deleteModel($crudgeneratorId);
    }
}