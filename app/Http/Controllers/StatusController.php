<?php
namespace App\Http\Controllers;

use Throwable;
use App\Models\Status;
use App\Services\StatusService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Requests\StoreStatusRequest;
use App\Http\Requests\UpdateStatusRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class StatusControllerController
 * @package  App\Http\Controllers
 */
class StatusController extends Controller
{
    private StatusService $service;

    public function __construct(StatusService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *  path="/api/status",
     *  operationId="indexStatus",
     *  tags={"Statuss"},
     *  summary="Get list of Status",
     *  description="Returns list of Status",
     *  @OA\Response(response=200, description="Successful operation",
     *    @OA\JsonContent(ref="#/components/schemas/Status"),
     *  ),
     * )
     *
     * Display a listing of Status.
     * @return LengthAwarePaginator
     * @throws Throwable
     */
    public function index(Request $request): LengthAwarePaginator|Collection
    {
        return $this->service->paginatedList($request->all());
    }

    /**
     * @OA\Post(
     *  operationId="storeStatus",
     *  summary="Insert a new Status",
     *  description="Insert a new Status",
     *  tags={"Statuss"},
     *  path="/api/status",
     *  @OA\RequestBody(
     *    description="Status to create",
     *    required=true,
     *    @OA\MediaType(
     *      mediaType="application/json",
     *      @OA\Schema(
     *      @OA\Property(
     *      title="data",
     *      property="data",
     *      type="object",
     *      ref="#/components/schemas/Status")
     *     )
     *    )
     *  ),
     *  @OA\Response(response="201",description="Status created",
     *     @OA\JsonContent(
     *      @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Status"
     *      ),
     *    ),
     *  ),
     *  @OA\Response(response=422,description="Validation exception"),
     * )
     *
     * @param StoreStatusRequest $request
     * @return array|Builder|Collection|Status|Builder[]|Status[]
     * @throws Throwable
     */
    public function store(StoreStatusRequest $request): array |Builder|Collection|Status
    {
        return $this->service->createModel($request->validated('data'));

    }

    /**
     * @OA\Get(
     *   path="/api/status/{status_id}",
     *   summary="Show a Status from his Id",
     *   description="Show a Status from his Id",
     *   operationId="showStatus",
     *   tags={"Statuss"},
     *   @OA\Parameter(ref="#/components/parameters/Status--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Status"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="Status not found"),
     * )
     *
     * @param $crudgeneratorId
     * @return array|Builder|Collection|Status
     * @throws Throwable
     */
    public function show($crudgeneratorId): array |Builder|Collection|Status
    {
        return $this->service->getModelById($crudgeneratorId);
    }

    /**
     * @OA\Patch(
     *   operationId="updateStatus",
     *   summary="Update an existing Status",
     *   description="Update an existing Status",
     *   tags={"Statuss"},
     *   path="/api/status/{status_id}",
     *   @OA\Parameter(ref="#/components/parameters/Status--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Status"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="Status not found"),
     *   @OA\RequestBody(
     *     description="Status to update",
     *     required=true,
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *        @OA\Property(
     *        title="data",
     *        property="data",
     *        type="object",
     *        ref="#/components/schemas/Status")
     *      )
     *     )
     *   )
     *
     * )
     *
     * @param UpdateStatusRequest $request
     * @param int $crudgeneratorId
     * @return array|Builder|Builder[]|Collection|Status|Status[]
     * @throws Throwable
     */
    public function update(UpdateStatusRequest $request, int $crudgeneratorId): array |Status|Collection|Builder
    {
        return $this->service->updateModel($request->validated('data'), $crudgeneratorId);

    }

    /**
     * @OA\Delete(
     *  path="/api/status/{status_id}",
     *  summary="Delete a Status",
     *  description="Delete a Status",
     *  operationId="destroyStatus",
     *  tags={"Statuss"},
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Status"
     *       ),
     *     ),
     *   ),
     *  @OA\Parameter(ref="#/components/parameters/Status--id"),
     *  @OA\Response(response=204,description="No content"),
     *  @OA\Response(response=404,description="Status not found"),
     * )
     *
     * @param int $crudgeneratorId
     * @return array|Builder|Builder[]|Collection|Status|Status[]
     * @throws Throwable
     */
    public function destroy(int $crudgeneratorId): array |Builder|Collection|Status
    {
        return $this->service->deleteModel($crudgeneratorId);
    }
}