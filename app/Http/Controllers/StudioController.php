<?php
namespace App\Http\Controllers;

use Throwable;
use App\Models\Studio;
use App\Services\StudioService;
use App\Http\Requests\StoreStudioRequest;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\UpdateStudioRequest;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;


/**
 * Class StudioController
 * @package  App\Http\Controllers
 */
class StudioController extends Controller
{
    private StudioService $service;


    public function __construct(StudioService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *  path="/api/studio",
     *  operationId="indexStudio",
     *  tags={"Studio"},
     *  summary="Get list of Studio",
     *  description="Returns list of Studio",
     *  @OA\Response(response=200, description="Successful operation",
     *    @OA\JsonContent(ref="#/components/schemas/Studio"),
     *  ),
     * )
     *
     * Display a listing of Studio.
     * @return LengthAwarePaginator
     * @throws Throwable
     */
    public function index(Request $request): LengthAwarePaginator|Collection
    {
        return $this->service->paginatedList($request->all());
    }

    /**
     * @OA\Post(
     *  operationId="storeStudio",
     *  summary="Insert a new Studio",
     *  description="Insert a new Studio",
     *  tags={"Studio"},
     *  path="/api/studio",
     *  @OA\RequestBody(
     *    description="Studio to create",
     *    required=true,
     *    @OA\MediaType(
     *      mediaType="application/json",
     *      @OA\Schema(
     *      @OA\Property(
     *      title="data",
     *      property="data",
     *      type="object",
     *      ref="#/components/schemas/Studio")
     *     )
     *    )
     *  ),
     *  @OA\Response(response="201",description="Studio created",
     *     @OA\JsonContent(
     *      @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Studio"
     *      ),
     *    ),
     *  ),
     *  @OA\Response(response=422,description="Validation exception"),
     * )
     *
     */
    public function store(StoreStudioRequest $request): array |Builder|Collection|Studio
    {
        return $this->service->createModel($request->validated('data'));
    }

    /**
     * @OA\Get(
     *   path="/api/studio/{studio_id}",
     *   summary="Show a Studio from his Id",
     *   description="Show a Studio from his Id",
     *   operationId="showStudio",
     *   tags={"Studio"},
     *   @OA\Parameter(ref="#/components/parameters/Studio--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Studio"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="Studio not found"),
     * )
     *
     * @param $crudgeneratorId
     * @return array|Builder|Collection|Studio
     * @throws Throwable
     */
    public function show($crudgeneratorId): array |Builder|Collection|Studio
    {
        return $this->service->getModelById($crudgeneratorId);
    }

    /**
     * @OA\Patch(
     *   operationId="updateStudio",
     *   summary="Update an existing Studio",
     *   description="Update an existing Studio",
     *   tags={"Studio"},
     *   path="/api/studio/{studio_id}",
     *   @OA\Parameter(ref="#/components/parameters/Studio--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Studio"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="Studio not found"),
     *   @OA\RequestBody(
     *     description="Studio to update",
     *     required=true,
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *        @OA\Property(
     *        title="data",
     *        property="data",
     *        type="object",
     *        ref="#/components/schemas/Studio")
     *      )
     *     )
     *   )
     *
     * )
     *
     * @param UpdateStudioRequest $request
     * @param int $crudgeneratorId
     * @return array|Builder|Builder[]|Collection|Studio|Studio[]
     * @throws Throwable
     */
    public function update(UpdateStudioRequest $request, int $crudgeneratorId): array |Studio|Collection|Builder
    {
        return $this->service->updateModel($request->validated('data'), $crudgeneratorId);

    }

    /**
     * @OA\Delete(
     *  path="/api/studio/{studio_id}",
     *  summary="Delete a Studio",
     *  description="Delete a Studio",
     *  operationId="destroyStudio",
     *  tags={"Studio"},
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Studio"
     *       ),
     *     ),
     *   ),
     *  @OA\Parameter(ref="#/components/parameters/Studio--id"),
     *  @OA\Response(response=204,description="No content"),
     *  @OA\Response(response=404,description="Studio not found"),
     * )
     *
     * @param int $crudgeneratorId
     * @return array|Builder|Builder[]|Collection|Studio|Studio[]
     * @throws Throwable
     */
    public function destroy(int $crudgeneratorId): array |Builder|Collection|Studio
    {
        return $this->service->deleteModel($crudgeneratorId);
    }
}