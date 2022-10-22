<?php
namespace App\Http\Controllers;

use Throwable;
use App\Models\Serie;
use App\Services\SerieService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Requests\StoreSerieRequest;
use App\Http\Requests\UpdateSerieRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class SerieControllerController
 * @package  App\Http\Controllers
 */
class SerieController extends Controller
{
    private SerieService $service;

    public function __construct(SerieService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *  path="/api/serie",
     *  operationId="indexSerie",
     *  tags={"Series"},
     *  summary="Get list of Serie",
     *  description="Returns list of Serie",
     *  @OA\Response(response=200, description="Successful operation",
     *    @OA\JsonContent(ref="#/components/schemas/Serie"),
     *  ),
     * )
     *
     * Display a listing of Serie.
     * @return LengthAwarePaginator
     * @throws Throwable
     */
    public function index(Request $request): LengthAwarePaginator|Collection
    {
        return $this->service->paginatedList($request->all());
    }

    /**
     * @OA\Post(
     *  operationId="storeSerie",
     *  summary="Insert a new Serie",
     *  description="Insert a new Serie",
     *  tags={"Series"},
     *  path="/api/serie",
     *  @OA\RequestBody(
     *    description="Serie to create",
     *    required=true,
     *    @OA\MediaType(
     *      mediaType="application/json",
     *      @OA\Schema(
     *      @OA\Property(
     *      title="data",
     *      property="data",
     *      type="object",
     *      ref="#/components/schemas/Serie")
     *     )
     *    )
     *  ),
     *  @OA\Response(response="201",description="Serie created",
     *     @OA\JsonContent(
     *      @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Serie"
     *      ),
     *    ),
     *  ),
     *  @OA\Response(response=422,description="Validation exception"),
     * )
     *
     * @param StoreSerieRequest $request
     * @return array|Builder|Collection|Serie|Builder[]|Serie[]
     * @throws Throwable
     */
    public function store(StoreSerieRequest $request): array |Builder|Collection|Serie
    {
        return $this->service->createModel($request->validated('data'));

    }

    /**
     * @OA\Get(
     *   path="/api/serie/{serie_id}",
     *   summary="Show a Serie from his Id",
     *   description="Show a Serie from his Id",
     *   operationId="showSerie",
     *   tags={"Series"},
     *   @OA\Parameter(ref="#/components/parameters/Serie--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Serie"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="Serie not found"),
     * )
     *
     * @param $crudgeneratorId
     * @return array|Builder|Collection|Serie
     * @throws Throwable
     */
    public function show($crudgeneratorId): array |Builder|Collection|Serie
    {
        return $this->service->getModelById($crudgeneratorId);
    }

    /**
     * @OA\Patch(
     *   operationId="updateSerie",
     *   summary="Update an existing Serie",
     *   description="Update an existing Serie",
     *   tags={"Series"},
     *   path="/api/serie/{serie_id}",
     *   @OA\Parameter(ref="#/components/parameters/Serie--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Serie"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="Serie not found"),
     *   @OA\RequestBody(
     *     description="Serie to update",
     *     required=true,
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *        @OA\Property(
     *        title="data",
     *        property="data",
     *        type="object",
     *        ref="#/components/schemas/Serie")
     *      )
     *     )
     *   )
     *
     * )
     *
     * @param UpdateSerieRequest $request
     * @param int $crudgeneratorId
     * @return array|Builder|Builder[]|Collection|Serie|Serie[]
     * @throws Throwable
     */
    public function update(UpdateSerieRequest $request, int $crudgeneratorId): array |Serie|Collection|Builder
    {
        return $this->service->updateModel($request->validated('data'), $crudgeneratorId);

    }

    /**
     * @OA\Delete(
     *  path="/api/serie/{serie_id}",
     *  summary="Delete a Serie",
     *  description="Delete a Serie",
     *  operationId="destroySerie",
     *  tags={"Series"},
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Serie"
     *       ),
     *     ),
     *   ),
     *  @OA\Parameter(ref="#/components/parameters/Serie--id"),
     *  @OA\Response(response=204,description="No content"),
     *  @OA\Response(response=404,description="Serie not found"),
     * )
     *
     * @param int $crudgeneratorId
     * @return array|Builder|Builder[]|Collection|Serie|Serie[]
     * @throws Throwable
     */
    public function destroy(int $crudgeneratorId): array |Builder|Collection|Serie
    {
        return $this->service->deleteModel($crudgeneratorId);
    }
}