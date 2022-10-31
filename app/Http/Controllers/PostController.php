<?php
namespace App\Http\Controllers;

use Throwable;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class PostControllerController
 * @package  App\Http\Controllers
 */
class PostController extends Controller
{
    private PostService $service;

    public function __construct(PostService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *  path="/api/post",
     *  operationId="indexPost",
     *  tags={"Posts"},
     *  summary="Get list of Post",
     *  description="Returns list of Post",
     *  @OA\Response(response=200, description="Successful operation",
     *    @OA\JsonContent(ref="#/components/schemas/Post"),
     *  ),
     * )
     *
     * Display a listing of Post.
     * @return LengthAwarePaginator
     * @throws Throwable
     */
    public function index(Request $request): LengthAwarePaginator|Collection
    {
        return $this->service->paginatedList($request->all());
    }

    /**
     * @OA\Post(
     *  operationId="storePost",
     *  summary="Insert a new Post",
     *  description="Insert a new Post",
     *  tags={"Posts"},
     *  path="/api/post",
     *  @OA\RequestBody(
     *    description="Post to create",
     *    required=true,
     *    @OA\MediaType(
     *      mediaType="application/json",
     *      @OA\Schema(
     *      @OA\Property(
     *      title="data",
     *      property="data",
     *      type="object",
     *      ref="#/components/schemas/Post")
     *     )
     *    )
     *  ),
     *  @OA\Response(response="201",description="Post created",
     *     @OA\JsonContent(
     *      @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Post"
     *      ),
     *    ),
     *  ),
     *  @OA\Response(response=422,description="Validation exception"),
     * )
     *
     * @param StorePostRequest $request
     * @return array|Builder|Collection|Post|Builder[]|Post[]
     * @throws Throwable
     */
    public function store(StorePostRequest $request): array |Builder|Collection|Post
    {
        return $this->service->createModel($request->validated('data'));

    }

    /**
     * @OA\Get(
     *   path="/api/post/{post_id}",
     *   summary="Show a Post from his Id",
     *   description="Show a Post from his Id",
     *   operationId="showPost",
     *   tags={"Posts"},
     *   @OA\Parameter(ref="#/components/parameters/Post--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Post"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="Post not found"),
     * )
     *
     * @param $crudgeneratorId
     * @return array|Builder|Collection|Post
     * @throws Throwable
     */
    public function show($crudgeneratorId): array |Builder|Collection|Post
    {
        return $this->service->getModelById($crudgeneratorId);
    }

    /**
     * @OA\Patch(
     *   operationId="updatePost",
     *   summary="Update an existing Post",
     *   description="Update an existing Post",
     *   tags={"Posts"},
     *   path="/api/post/{post_id}",
     *   @OA\Parameter(ref="#/components/parameters/Post--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Post"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="Post not found"),
     *   @OA\RequestBody(
     *     description="Post to update",
     *     required=true,
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *        @OA\Property(
     *        title="data",
     *        property="data",
     *        type="object",
     *        ref="#/components/schemas/Post")
     *      )
     *     )
     *   )
     *
     * )
     *
     * @param UpdatePostRequest $request
     * @param int $crudgeneratorId
     * @return array|Builder|Builder[]|Collection|Post|Post[]
     * @throws Throwable
     */
    public function update(UpdatePostRequest $request, int $crudgeneratorId): array |Post|Collection|Builder
    {
        return $this->service->updateModel($request->validated('data'), $crudgeneratorId);

    }

    /**
     * @OA\Delete(
     *  path="/api/post/{post_id}",
     *  summary="Delete a Post",
     *  description="Delete a Post",
     *  operationId="destroyPost",
     *  tags={"Posts"},
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Post"
     *       ),
     *     ),
     *   ),
     *  @OA\Parameter(ref="#/components/parameters/Post--id"),
     *  @OA\Response(response=204,description="No content"),
     *  @OA\Response(response=404,description="Post not found"),
     * )
     *
     * @param int $crudgeneratorId
     * @return array|Builder|Builder[]|Collection|Post|Post[]
     * @throws Throwable
     */
    public function destroy(int $crudgeneratorId): array |Builder|Collection|Post
    {
        return $this->service->deleteModel($crudgeneratorId);
    }
}