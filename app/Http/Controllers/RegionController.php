<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreRegionRequest;
use App\Http\Requests\UpdateRegionRequest;
use App\Models\Region;
use App\Services\RegionService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Throwable;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class RegionControllerController
 * @package  App\Http\Controllers
 */
class RegionController extends Controller
{
    private RegionService $service;

    public function __construct(RegionService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *  path="/api/region",
     *  operationId="indexRegion",
     *  tags={"Regions"},
     *  summary="Get list of Region",
     *  description="Returns list of Region",
     *  @OA\Response(response=200, description="Successful operation",
     *    @OA\JsonContent(ref="#/components/schemas/Regions"),
     *  ),
     * )
     *
     * Display a listing of Region.
     * @return LengthAwarePaginator
     * @throws Throwable
     */
    public function index(Request $request): LengthAwarePaginator|Collection
    {
        return $this->service->paginatedList($request->all(),$request->has('all'));
    }

    /**
     * @OA\Post(
     *  operationId="storeRegion",
     *  summary="Insert a new Region",
     *  description="Insert a new Region",
     *  tags={"Regions"},
     *  path="/api/region",
     *  @OA\RequestBody(
     *    description="Region to create",
     *    required=true,
     *    @OA\MediaType(
     *      mediaType="application/json",
     *      @OA\Schema(
     *      @OA\Property(
     *      title="data",
     *      property="data",
     *      type="object",
     *      ref="#/components/schemas/Region")
     *     )
     *    )
     *  ),
     *  @OA\Response(response="201",description="Region created",
     *     @OA\JsonContent(
     *      @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Region"
     *      ),
     *    ),
     *  ),
     *  @OA\Response(response=422,description="Validation exception"),
     * )
     *
     * @param StoreRegionRequest $request
     * @return array|Builder|Collection|Region|Builder[]|Region[]
     * @throws Throwable
     */
    public function store(StoreRegionRequest $request): array|Builder|Collection|Region
    {
        return $this->service->createModel($request->validated('data'));

    }

    /**
     * @OA\Get(
     *   path="/api/region/{region_id}",
     *   summary="Show a Region from his Id",
     *   description="Show a Region from his Id",
     *   operationId="showRegion",
     *   tags={"Regions"},
     *   @OA\Parameter(ref="#/components/parameters/Region--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Region"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="Region not found"),
     * )
     *
     * @param $productId
     * @return array|Builder|Collection|Region
     * @throws Throwable
     */
    public function show($productId): array|Builder|Collection|Region
    {
        return $this->service->getModelById($productId);
    }

    /**
     * @OA\Patch(
     *   operationId="updateRegion",
     *   summary="Update an existing Region",
     *   description="Update an existing Region",
     *   tags={"Regions"},
     *   path="/api/region/{region_id}",
     *   @OA\Parameter(ref="#/components/parameters/Region--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Region"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="Region not found"),
     *   @OA\RequestBody(
     *     description="Region to update",
     *     required=true,
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *        @OA\Property(
     *        title="data",
     *        property="data",
     *        type="object",
     *        ref="#/components/schemas/Region")
     *      )
     *     )
     *   )
     *
     * )
     *
     * @param UpdateRegionRequest $request
     * @param int $productId
     * @return array|Builder|Builder[]|Collection|Region|Region[]
     * @throws Throwable
     */
    public function update(UpdateRegionRequest $request,int $productId): array|Region|Collection|Builder
    {
        return $this->service->updateModel($request->validated('data'),$productId);

    }

    /**
     * @OA\Delete(
     *  path="/api/region/{region_id}",
     *  summary="Delete a Region",
     *  description="Delete a Region",
     *  operationId="destroyRegion",
     *  tags={"Regions"},
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Region"
     *       ),
     *     ),
     *   ),
     *  @OA\Parameter(ref="#/components/parameters/Region--id"),
     *  @OA\Response(response=204,description="No content"),
     *  @OA\Response(response=404,description="Region not found"),
     * )
     *
     * @param int $productId
     * @return array|Builder|Builder[]|Collection|Region|Region[]
     * @throws Throwable
     */
    public function destroy(int $productId): array|Builder|Collection|Region
    {
        return $this->service->deleteModel($productId);
    }


      
}
