<?php
namespace App\Http\Controllers;

use Throwable;
use App\Models\Genre;
use App\Services\GenreService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Requests\StoreGenreRequest;
use App\Http\Requests\UpdateGenreRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class GenreControllerController
 * @package  App\Http\Controllers
 */
class GenreController extends Controller
{
    private GenreService $service;

    public function __construct(GenreService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *  path="/api/genre",
     *  operationId="indexGenre",
     *  tags={"Genres"},
     *  summary="Get list of Genre",
     *  description="Returns list of Genre",
     *  @OA\Response(response=200, description="Successful operation",
     *    @OA\JsonContent(ref="#/components/schemas/Genre"),
     *  ),
     * )
     *
     * Display a listing of Genre.
     * @return LengthAwarePaginator
     * @throws Throwable
     */
    public function index(Request $request): LengthAwarePaginator|Collection
    {
        return $this->service->paginatedList($request->all());
    }

    /**
     * @OA\Post(
     *  operationId="storeGenre",
     *  summary="Insert a new Genre",
     *  description="Insert a new Genre",
     *  tags={"Genres"},
     *  path="/api/genre",
     *  @OA\RequestBody(
     *    description="Genre to create",
     *    required=true,
     *    @OA\MediaType(
     *      mediaType="application/json",
     *      @OA\Schema(
     *      @OA\Property(
     *      title="data",
     *      property="data",
     *      type="object",
     *      ref="#/components/schemas/Genre")
     *     )
     *    )
     *  ),
     *  @OA\Response(response="201",description="Genre created",
     *     @OA\JsonContent(
     *      @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Genre"
     *      ),
     *    ),
     *  ),
     *  @OA\Response(response=422,description="Validation exception"),
     * )
     *
     * @param StoreGenreRequest $request
     * @return array|Builder|Collection|Genre|Builder[]|Genre[]
     * @throws Throwable
     */
    public function store(StoreGenreRequest $request): array |Builder|Collection|Genre
    {
        return $this->service->createModel($request->validated('data'));
    }

    /**
     * @OA\Get(
     *   path="/api/genre/{genre_id}",
     *   summary="Show a Genre from his Id",
     *   description="Show a Genre from his Id",
     *   operationId="showGenre",
     *   tags={"Genres"},
     *   @OA\Parameter(ref="#/components/parameters/Genre--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Genre"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="Genre not found"),
     * )
     *
     * @param $crudgeneratorId
     * @return array|Builder|Collection|Genre
     * @throws Throwable
     */
    public function show($crudgeneratorId): array |Builder|Collection|Genre
    {
        return $this->service->getModelById($crudgeneratorId, ['subGenres']);
    }

    /**
     * @OA\Patch(
     *   operationId="updateGenre",
     *   summary="Update an existing Genre",
     *   description="Update an existing Genre",
     *   tags={"Genres"},
     *   path="/api/genre/{genre_id}",
     *   @OA\Parameter(ref="#/components/parameters/Genre--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Genre"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="Genre not found"),
     *   @OA\RequestBody(
     *     description="Genre to update",
     *     required=true,
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *        @OA\Property(
     *        title="data",
     *        property="data",
     *        type="object",
     *        ref="#/components/schemas/Genre")
     *      )
     *     )
     *   )
     *
     * )
     *
     * @param UpdateGenreRequest $request
     * @param int $crudgeneratorId
     * @return array|Builder|Builder[]|Collection|Genre|Genre[]
     * @throws Throwable
     */
    public function update(UpdateGenreRequest $request, int $crudgeneratorId): array |Genre|Collection|Builder
    {
        return $this->service->updateModel($request->validated('data'), $crudgeneratorId);

    }

    /**
     * @OA\Delete(
     *  path="/api/genre/{genre_id}",
     *  summary="Delete a Genre",
     *  description="Delete a Genre",
     *  operationId="destroyGenre",
     *  tags={"Genres"},
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Genre"
     *       ),
     *     ),
     *   ),
     *  @OA\Parameter(ref="#/components/parameters/Genre--id"),
     *  @OA\Response(response=204,description="No content"),
     *  @OA\Response(response=404,description="Genre not found"),
     * )
     *
     * @param int $crudgeneratorId
     * @return array|Builder|Builder[]|Collection|Genre|Genre[]
     * @throws Throwable
     */
    public function destroy(int $crudgeneratorId): array |Builder|Collection|Genre
    {
        return $this->service->deleteModel($crudgeneratorId);
    }
}