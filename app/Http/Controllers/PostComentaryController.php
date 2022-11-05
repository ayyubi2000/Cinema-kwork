<?php
namespace App\Http\Controllers;

use Throwable;
use App\Models\PostComentary;
use App\Services\PostComentaryService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Requests\StorePostComentaryRequest;
use App\Http\Requests\UpdatePostComentaryRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class PostComentaryControllerController
 * @package  App\Http\Controllers
 */
class PostComentaryController extends Controller
{
    private PostComentaryService $service;

    public function __construct(PostComentaryService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *  path="/api/post-comentary",
     *  operationId="indexPostComentary",
     *  tags={"PostComentarys"},
     *  summary="Get list of PostComentary",
     *  description="Returns list of PostComentary",
     *  @OA\Response(response=200, description="Successful operation",
     *    @OA\JsonContent(ref="#/components/schemas/PostComentary"),
     *  ),
     * )
     *
     * Display a listing of PostComentary.
     * @return LengthAwarePaginator
     * @throws Throwable
     */
    public function index(Request $request): LengthAwarePaginator|Collection
    {
        return $this->service->paginatedList($request->all());
    }

    /**
     * @OA\Post(
     *  operationId="storePostComentary",
     *  summary="Insert a new PostComentary",
     *  description="Insert a new PostComentary",
     *  tags={"PostComentarys"},
     *  path="/api/post-comentary",
     *  @OA\RequestBody(
     *    description="PostComentary to create",
     *    required=true,
     *    @OA\MediaType(
     *      mediaType="application/json",
     *      @OA\Schema(
     *      @OA\Property(
     *      title="data",
     *      property="data",
     *      type="object",
     *      ref="#/components/schemas/PostComentary")
     *     )
     *    )
     *  ),
     *  @OA\Response(response="201",description="PostComentary created",
     *     @OA\JsonContent(
     *      @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/PostComentary"
     *      ),
     *    ),
     *  ),
     *  @OA\Response(response=422,description="Validation exception"),
     * )
     *
     * @param StorePostComentaryRequest $request
     * @return array|Builder|Collection|PostComentary|Builder[]|PostComentary[]
     * @throws Throwable
     */
    public function store(StorePostComentaryRequest $request): array |Builder|Collection|PostComentary
    {
        return $this->service->createModel($request->validated('data'));

    }

    /**
     * @OA\Get(
     *   path="/api/post-comentary/{postcomentary_id}",
     *   summary="Show a PostComentary from his Id",
     *   description="Show a PostComentary from his Id",
     *   operationId="showPostComentary",
     *   tags={"PostComentarys"},
     *   @OA\Parameter(ref="#/components/parameters/PostComentary--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/PostComentary"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="PostComentary not found"),
     * )
     *
     * @param $crudgeneratorId
     * @return array|Builder|Collection|PostComentary
     * @throws Throwable
     */
    public function show($crudgeneratorId): array |Builder|Collection|PostComentary
    {
        return $this->service->getModelById($crudgeneratorId);
    }

    /**
     * @OA\Patch(
     *   operationId="updatePostComentary",
     *   summary="Update an existing PostComentary",
     *   description="Update an existing PostComentary",
     *   tags={"PostComentarys"},
     *   path="/api/post-comentary/{postcomentary_id}",
     *   @OA\Parameter(ref="#/components/parameters/PostComentary--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/PostComentary"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="PostComentary not found"),
     *   @OA\RequestBody(
     *     description="PostComentary to update",
     *     required=true,
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *        @OA\Property(
     *        title="data",
     *        property="data",
     *        type="object",
     *        ref="#/components/schemas/PostComentary")
     *      )
     *     )
     *   )
     *
     * )
     *
     * @param UpdatePostComentaryRequest $request
     * @param int $crudgeneratorId
     * @return array|Builder|Builder[]|Collection|PostComentary|PostComentary[]
     * @throws Throwable
     */
    public function update(UpdatePostComentaryRequest $request, int $crudgeneratorId): array |PostComentary|Collection|Builder
    {
        return $this->service->updateModel($request->validated('data'), $crudgeneratorId);

    }

    /**
     * @OA\Delete(
     *  path="/api/post-comentary/{postcomentary_id}",
     *  summary="Delete a PostComentary",
     *  description="Delete a PostComentary",
     *  operationId="destroyPostComentary",
     *  tags={"PostComentarys"},
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/PostComentary"
     *       ),
     *     ),
     *   ),
     *  @OA\Parameter(ref="#/components/parameters/PostComentary--id"),
     *  @OA\Response(response=204,description="No content"),
     *  @OA\Response(response=404,description="PostComentary not found"),
     * )
     *
     * @param int $crudgeneratorId
     * @return array|Builder|Builder[]|Collection|PostComentary|PostComentary[]
     * @throws Throwable
     */
    public function destroy(int $crudgeneratorId): array |Builder|Collection|PostComentary
    {
        return $this->service->deleteModel($crudgeneratorId);
    }
}