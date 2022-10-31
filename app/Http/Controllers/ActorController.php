<?php
namespace App\Http\Controllers;

use Throwable;
use App\Models\Actor;
use App\Services\ActorService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Requests\StoreActorRequest;
use App\Http\Requests\UpdateActorRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class ActorControllerController
 * @package  App\Http\Controllers
 */
class ActorController extends Controller
{
    private ActorService $service;

    public function __construct(ActorService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *  path="/api/actor",
     *  operationId="indexActor",
     *  tags={"Actors"},
     *  summary="Get list of Actor",
     *  description="Returns list of Actor",
     *  @OA\Response(response=200, description="Successful operation",
     *    @OA\JsonContent(ref="#/components/schemas/Actor"),
     *  ),
     * )
     *
     * Display a listing of Actor.
     * @return LengthAwarePaginator
     * @throws Throwable
     */
    public function index(Request $request): LengthAwarePaginator|Collection
    {
        return $this->service->paginatedList($request->all());
    }

    /**
     * @OA\Post(
     *  operationId="storeActor",
     *  summary="Insert a new Actor",
     *  description="Insert a new Actor",
     *  tags={"Actors"},
     *  path="/api/actor",
     *  @OA\RequestBody(
     *    description="Actor to create",
     *    required=true,
     *    @OA\MediaType(
     *      mediaType="application/json",
     *      @OA\Schema(
     *      @OA\Property(
     *      title="data",
     *      property="data",
     *      type="object",
     *      ref="#/components/schemas/Actor")
     *     )
     *    )
     *  ),
     *  @OA\Response(response="201",description="Actor created",
     *     @OA\JsonContent(
     *      @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Actor"
     *      ),
     *    ),
     *  ),
     *  @OA\Response(response=422,description="Validation exception"),
     * )
     *
     * @param StoreActorRequest $request
     * @return array|Builder|Collection|Actor|Builder[]|Actor[]
     * @throws Throwable
     */
    public function store(StoreActorRequest $request): array |Builder|Collection|Actor
    {
        return $this->service->createModel($request->validated('data'));
    }

    /**
     * @OA\Get(
     *   path="/api/actor/{actor_id}",
     *   summary="Show a Actor from his Id",
     *   description="Show a Actor from his Id",
     *   operationId="showActor",
     *   tags={"Actors"},
     *   @OA\Parameter(ref="#/components/parameters/Actor--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Actor"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="Actor not found"),
     * )
     *
     * @param $crudgeneratorId
     * @return array|Builder|Collection|Actor
     * @throws Throwable
     */
    public function show($crudgeneratorId): array |Builder|Collection|Actor
    {
        return $this->service->getModelById($crudgeneratorId);
    }

    /**
     * @OA\Patch(
     *   operationId="updateActor",
     *   summary="Update an existing Actor",
     *   description="Update an existing Actor",
     *   tags={"Actors"},
     *   path="/api/actor/{actor_id}",
     *   @OA\Parameter(ref="#/components/parameters/Actor--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Actor"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="Actor not found"),
     *   @OA\RequestBody(
     *     description="Actor to update",
     *     required=true,
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *        @OA\Property(
     *        title="data",
     *        property="data",
     *        type="object",
     *        ref="#/components/schemas/Actor")
     *      )
     *     )
     *   )
     *
     * )
     *
     * @param UpdateActorRequest $request
     * @param int $crudgeneratorId
     * @return array|Builder|Builder[]|Collection|Actor|Actor[]
     * @throws Throwable
     */
    public function update(UpdateActorRequest $request, int $crudgeneratorId): array |Actor|Collection|Builder
    {
        return $this->service->updateModel($request->validated('data'), $crudgeneratorId);

    }

    /**
     * @OA\Delete(
     *  path="/api/actor/{actor_id}",
     *  summary="Delete a Actor",
     *  description="Delete a Actor",
     *  operationId="destroyActor",
     *  tags={"Actors"},
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Actor"
     *       ),
     *     ),
     *   ),
     *  @OA\Parameter(ref="#/components/parameters/Actor--id"),
     *  @OA\Response(response=204,description="No content"),
     *  @OA\Response(response=404,description="Actor not found"),
     * )
     *
     * @param int $crudgeneratorId
     * @return array|Builder|Builder[]|Collection|Actor|Actor[]
     * @throws Throwable
     */
    public function destroy(int $crudgeneratorId): array |Builder|Collection|Actor
    {
        return $this->service->deleteModel($crudgeneratorId);
    }
}