<?php
namespace App\Http\Controllers;

use Throwable;
use App\Models\AwardsPhoto;
use App\Services\AwardsPhotoService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Requests\StoreAwardsPhotoRequest;
use App\Http\Requests\UpdateAwardsPhotoRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class AwardsPhotoControllerController
 * @package  App\Http\Controllers
 */
class AwardsPhotoController extends Controller
{
    private AwardsPhotoService $service;

    public function __construct(AwardsPhotoService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *  path="/api/awards-photos",
     *  operationId="indexAwardsPhoto",
     *  tags={"AwardsPhotos"},
     *  summary="Get list of AwardsPhoto",
     *  description="Returns list of AwardsPhoto",
     *  @OA\Response(response=200, description="Successful operation",
     *    @OA\JsonContent(ref="#/components/schemas/AwardsPhoto"),
     *  ),
     * )
     *
     * Display a listing of AwardsPhoto.
     * @return LengthAwarePaginator
     * @throws Throwable
     */
    public function index(Request $request): LengthAwarePaginator|Collection
    {
        return $this->service->paginatedList($request->all());
    }

    /**
     * @OA\Post(
     *  operationId="storeAwardsPhoto",
     *  summary="Insert a new AwardsPhoto",
     *  description="Insert a new AwardsPhoto",
     *  tags={"AwardsPhotos"},
     *  path="/api/awards-photos",
     *  @OA\RequestBody(
     *    description="AwardsPhoto to create",
     *    required=true,
     *    @OA\MediaType(
     *      mediaType="application/json",
     *      @OA\Schema(
     *      @OA\Property(
     *      title="data",
     *      property="data",
     *      type="object",
     *      ref="#/components/schemas/AwardsPhoto")
     *     )
     *    )
     *  ),
     *  @OA\Response(response="201",description="AwardsPhoto created",
     *     @OA\JsonContent(
     *      @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/AwardsPhoto"
     *      ),
     *    ),
     *  ),
     *  @OA\Response(response=422,description="Validation exception"),
     * )
     *
     * @param StoreAwardsPhotoRequest $request
     * @return array|Builder|Collection|AwardsPhoto|Builder[]|AwardsPhoto[]
     * @throws Throwable
     */
    public function store(StoreAwardsPhotoRequest $request): array |Builder|Collection|AwardsPhoto
    {
        return $this->service->createModel($request->validated('data'));

    }

    /**
     * @OA\Get(
     *   path="/api/awards-photos/{awardsphoto_id}",
     *   summary="Show a AwardsPhoto from his Id",
     *   description="Show a AwardsPhoto from his Id",
     *   operationId="showAwardsPhoto",
     *   tags={"AwardsPhotos"},
     *   @OA\Parameter(ref="#/components/parameters/AwardsPhoto--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/AwardsPhoto"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="AwardsPhoto not found"),
     * )
     *
     * @param $crudgeneratorId
     * @return array|Builder|Collection|AwardsPhoto
     * @throws Throwable
     */
    public function show($crudgeneratorId): array |Builder|Collection|AwardsPhoto
    {
        return $this->service->getModelById($crudgeneratorId);
    }

    /**
     * @OA\Patch(
     *   operationId="updateAwardsPhoto",
     *   summary="Update an existing AwardsPhoto",
     *   description="Update an existing AwardsPhoto",
     *   tags={"AwardsPhotos"},
     *   path="/api/awards-photos/{awardsphoto_id}",
     *   @OA\Parameter(ref="#/components/parameters/AwardsPhoto--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/AwardsPhoto"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="AwardsPhoto not found"),
     *   @OA\RequestBody(
     *     description="AwardsPhoto to update",
     *     required=true,
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *        @OA\Property(
     *        title="data",
     *        property="data",
     *        type="object",
     *        ref="#/components/schemas/AwardsPhoto")
     *      )
     *     )
     *   )
     *
     * )
     *
     * @param UpdateAwardsPhotoRequest $request
     * @param int $crudgeneratorId
     * @return array|Builder|Builder[]|Collection|AwardsPhoto|AwardsPhoto[]
     * @throws Throwable
     */
    public function update(UpdateAwardsPhotoRequest $request, int $crudgeneratorId): array |AwardsPhoto|Collection|Builder
    {
        return $this->service->updateModel($request->validated('data'), $crudgeneratorId);

    }

    /**
     * @OA\Delete(
     *  path="/api/awards-photos/{awardsphoto_id}",
     *  summary="Delete a AwardsPhoto",
     *  description="Delete a AwardsPhoto",
     *  operationId="destroyAwardsPhoto",
     *  tags={"AwardsPhotos"},
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/AwardsPhoto"
     *       ),
     *     ),
     *   ),
     *  @OA\Parameter(ref="#/components/parameters/AwardsPhoto--id"),
     *  @OA\Response(response=204,description="No content"),
     *  @OA\Response(response=404,description="AwardsPhoto not found"),
     * )
     *
     * @param int $crudgeneratorId
     * @return array|Builder|Builder[]|Collection|AwardsPhoto|AwardsPhoto[]
     * @throws Throwable
     */
    public function destroy(int $crudgeneratorId): array |Builder|Collection|AwardsPhoto
    {
        return $this->service->deleteModel($crudgeneratorId);
    }
}