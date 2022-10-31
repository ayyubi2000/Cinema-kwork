<?php
namespace App\Http\Controllers;

use Throwable;
use App\Models\LatestNewsComentary;
use App\Services\LatestNewsComentaryService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Requests\StoreLatestNewsComentaryRequest;
use App\Http\Requests\UpdateLatestNewsComentaryRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class LatestNewsComentaryControllerController
 * @package  App\Http\Controllers
 */
class LatestNewsComentaryController extends Controller
{
    private LatestNewsComentaryService $service;

    public function __construct(LatestNewsComentaryService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *  path="/api/latest-new-comentary",
     *  operationId="indexLatestNewsComentary",
     *  tags={"LatestNewsComentarys"},
     *  summary="Get list of LatestNewsComentary",
     *  description="Returns list of LatestNewsComentary",
     *  @OA\Response(response=200, description="Successful operation",
     *    @OA\JsonContent(ref="#/components/schemas/LatestNewsComentary"),
     *  ),
     * )
     *
     * Display a listing of LatestNewsComentary.
     * @return LengthAwarePaginator
     * @throws Throwable
     */
    public function index(Request $request): LengthAwarePaginator|Collection
    {
        return $this->service->paginatedList($request->all());
    }

    /**
     * @OA\Post(
     *  operationId="storeLatestNewsComentary",
     *  summary="Insert a new LatestNewsComentary",
     *  description="Insert a new LatestNewsComentary",
     *  tags={"LatestNewsComentarys"},
     *  path="/api/latest-new-comentary",
     *  @OA\RequestBody(
     *    description="LatestNewsComentary to create",
     *    required=true,
     *    @OA\MediaType(
     *      mediaType="application/json",
     *      @OA\Schema(
     *      @OA\Property(
     *      title="data",
     *      property="data",
     *      type="object",
     *      ref="#/components/schemas/LatestNewsComentary")
     *     )
     *    )
     *  ),
     *  @OA\Response(response="201",description="LatestNewsComentary created",
     *     @OA\JsonContent(
     *      @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/LatestNewsComentary"
     *      ),
     *    ),
     *  ),
     *  @OA\Response(response=422,description="Validation exception"),
     * )
     *
     * @param StoreLatestNewsComentaryRequest $request
     * @return array|Builder|Collection|LatestNewsComentary|Builder[]|LatestNewsComentary[]
     * @throws Throwable
     */
    public function store(StoreLatestNewsComentaryRequest $request): array |Builder|Collection|LatestNewsComentary
    {
        return $this->service->createModel($request->validated('data'));

    }

    /**
     * @OA\Get(
     *   path="/api/movie-new-comentary/{LatestNewsComentary_id}",
     *   summary="Show a LatestNewsComentary from his Id",
     *   description="Show a LatestNewsComentary from his Id",
     *   operationId="showLatestNewsComentary",
     *   tags={"LatestNewsComentarys"},
     *   @OA\Parameter(ref="#/components/parameters/LatestNewsComentary--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/LatestNewsComentary"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="LatestNewsComentary not found"),
     * )
     *
     * @param $crudgeneratorId
     * @return array|Builder|Collection|LatestNewsComentary
     * @throws Throwable
     */
    public function show($crudgeneratorId): array |Builder|Collection|LatestNewsComentary
    {
        return $this->service->getModelById($crudgeneratorId);
    }

    /**
     * @OA\Patch(
     *   operationId="updateLatestNewsComentary",
     *   summary="Update an existing LatestNewsComentary",
     *   description="Update an existing LatestNewsComentary",
     *   tags={"LatestNewsComentarys"},
     *   path="/api/movie-new-comentary/{LatestNewsComentary_id}",
     *   @OA\Parameter(ref="#/components/parameters/LatestNewsComentary--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/LatestNewsComentary"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="LatestNewsComentary not found"),
     *   @OA\RequestBody(
     *     description="LatestNewsComentary to update",
     *     required=true,
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *        @OA\Property(
     *        title="data",
     *        property="data",
     *        type="object",
     *        ref="#/components/schemas/LatestNewsComentary")
     *      )
     *     )
     *   )
     *
     * )
     *
     * @param UpdateLatestNewsComentaryRequest $request
     * @param int $crudgeneratorId
     * @return array|Builder|Builder[]|Collection|LatestNewsComentary|LatestNewsComentary[]
     * @throws Throwable
     */
    public function update(UpdateLatestNewsComentaryRequest $request, int $crudgeneratorId): array |LatestNewsComentary|Collection|Builder
    {
        return $this->service->updateModel($request->validated('data'), $crudgeneratorId);

    }

    /**
     * @OA\Delete(
     *  path="/api/movie-new-comentary/{LatestNewsComentary_id}",
     *  summary="Delete a LatestNewsComentary",
     *  description="Delete a LatestNewsComentary",
     *  operationId="destroyLatestNewsComentary",
     *  tags={"LatestNewsComentarys"},
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/LatestNewsComentary"
     *       ),
     *     ),
     *   ),
     *  @OA\Parameter(ref="#/components/parameters/LatestNewsComentary--id"),
     *  @OA\Response(response=204,description="No content"),
     *  @OA\Response(response=404,description="LatestNewsComentary not found"),
     * )
     *
     * @param int $crudgeneratorId
     * @return array|Builder|Builder[]|Collection|LatestNewsComentary|LatestNewsComentary[]
     * @throws Throwable
     */
    public function destroy(int $crudgeneratorId): array |Builder|Collection|LatestNewsComentary
    {
        return $this->service->deleteModel($crudgeneratorId);
    }
}