<?php
namespace App\Http\Controllers;

use Throwable;
use App\Models\StudioNew;
use App\Services\StudioNewService;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\StoreStudioNewRequest;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Requests\UpdateStudioNewRequest;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class StudioNewsControllerController
 * @package  App\Http\Controllers
 */
class StudioNewController extends Controller
{
    private StudioNewService $service;

    public function __construct(StudioNewService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *  path="/api/studio-news",
     *  operationId="indexStudioNews",
     *  tags={"StudioNews"},
     *  summary="Get list of StudioNews",
     *  description="Returns list of StudioNews",
     *  @OA\Response(response=200, description="Successful operation",
     *    @OA\JsonContent(ref="#/components/schemas/StudioNews"),
     *  ),
     * )
     *
     * Display a listing of StudioNews.
     * @return LengthAwarePaginator
     * @throws Throwable
     */
    public function index(Request $request): LengthAwarePaginator|Collection
    {
        return $this->service->paginatedList($request->all());
    }

    /**
     * @OA\Post(
     *  operationId="storeStudioNews",
     *  summary="Insert a new StudioNews",
     *  description="Insert a new StudioNews",
     *  tags={"StudioNews"},
     *  path="/api/studio-news",
     *  @OA\RequestBody(
     *    description="StudioNews to create",
     *    required=true,
     *    @OA\MediaType(
     *      mediaType="application/json",
     *      @OA\Schema(
     *      @OA\Property(
     *      title="data",
     *      property="data",
     *      type="object",
     *      ref="#/components/schemas/StudioNews")
     *     )
     *    )
     *  ),
     *  @OA\Response(response="201",description="StudioNews created",
     *     @OA\JsonContent(
     *      @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/StudioNews"
     *      ),
     *    ),
     *  ),
     *  @OA\Response(response=422,description="Validation exception"),
     * )
     *
     */
    public function store(StoreStudioNewRequest $request)
    {
        return $this->service->createModel($request->validated('data'));
    }

    /**
     * @OA\Get(
     *   path="/api/studio-news/{studionews_id}",
     *   summary="Show a StudioNews from his Id",
     *   description="Show a StudioNews from his Id",
     *   operationId="showStudioNews",
     *   tags={"StudioNews"},
     *   @OA\Parameter(ref="#/components/parameters/StudioNews--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/StudioNews"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="StudioNews not found"),
     * )
     *
     * @param $crudgeneratorId
     * @return array|Builder|Collection|StudioNew
     * @throws Throwable
     */
    public function show($crudgeneratorId): array |Builder|Collection|StudioNew
    {
        return $this->service->getModelById($crudgeneratorId);
    }

    /**
     * @OA\Patch(
     *   operationId="updateStudioNews",
     *   summary="Update an existing StudioNews",
     *   description="Update an existing StudioNews",
     *   tags={"StudioNews"},
     *   path="/api/studio-news/{studionews_id}",
     *   @OA\Parameter(ref="#/components/parameters/StudioNews--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/StudioNews"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="StudioNews not found"),
     *   @OA\RequestBody(
     *     description="StudioNews to update",
     *     required=true,
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *        @OA\Property(
     *        title="data",
     *        property="data",
     *        type="object",
     *        ref="#/components/schemas/StudioNews")
     *      )
     *     )
     *   )
     *
     * )
     *
     * @param UpdateStudioNewRequest $request
     * @param int $crudgeneratorId
     * @return array|Builder|Builder[]|Collection|StudioNew|StudioNew[]
     * @throws Throwable
     */
    public function update(UpdateStudioNewRequest $request, int $crudgeneratorId): array |StudioNew|Collection|Builder
    {
        return $this->service->updateModel($request->validated('data'), $crudgeneratorId);
    }

    /**
     * @OA\Delete(
     *  path="/api/studio-news/{studionews_id}",
     *  summary="Delete a StudioNews",
     *  description="Delete a StudioNews",
     *  operationId="destroyStudioNews",
     *  tags={"StudioNews"},
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/StudioNews"
     *       ),
     *     ),
     *   ),
     *  @OA\Parameter(ref="#/components/parameters/StudioNews--id"),
     *  @OA\Response(response=204,description="No content"),
     *  @OA\Response(response=404,description="StudioNews not found"),
     * )
     *
     * @param int $crudgeneratorId
     * @return array|Builder|Builder[]|Collection|StudioNew|StudioNew[]
     * @throws Throwable
     */
    public function destroy(int $crudgeneratorId): array |Builder|Collection|StudioNew
    {
        return $this->service->deleteModel($crudgeneratorId);
    }
}