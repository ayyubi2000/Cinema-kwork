<?php
namespace App\Http\Controllers;

use Throwable;
use App\Models\Rating;
use App\Services\RatingService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Requests\StoreRatingRequest;
use App\Http\Requests\UpdateRatingRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class RatingControllerController
 * @package  App\Http\Controllers
 */
class RatingController extends Controller
{
    private RatingService $service;

    public function __construct(RatingService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *  path="/api/rating",
     *  operationId="indexRating",
     *  tags={"Ratings"},
     *  summary="Get list of Rating",
     *  description="Returns list of Rating",
     *  @OA\Response(response=200, description="Successful operation",
     *    @OA\JsonContent(ref="#/components/schemas/Rating"),
     *  ),
     * )
     *
     * Display a listing of Rating.
     * @return LengthAwarePaginator
     * @throws Throwable
     */
    public function index(Request $request): LengthAwarePaginator|Collection
    {
        return $this->service->paginatedList($request->all());
    }

    /**
     * @OA\Post(
     *  operationId="storeRating",
     *  summary="Insert a new Rating",
     *  description="Insert a new Rating",
     *  tags={"Ratings"},
     *  path="/api/rating",
     *  @OA\RequestBody(
     *    description="Rating to create",
     *    required=true,
     *    @OA\MediaType(
     *      mediaType="application/json",
     *      @OA\Schema(
     *      @OA\Property(
     *      title="data",
     *      property="data",
     *      type="object",
     *      ref="#/components/schemas/Rating")
     *     )
     *    )
     *  ),
     *  @OA\Response(response="201",description="Rating created",
     *     @OA\JsonContent(
     *      @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Rating"
     *      ),
     *    ),
     *  ),
     *  @OA\Response(response=422,description="Validation exception"),
     * )
     *
     * @param StoreRatingRequest $request
     * @return array|Builder|Collection|Rating|Builder[]|Rating[]
     * @throws Throwable
     */
    public function store(StoreRatingRequest $request)
    {
        $rating = Rating::where('user_id', $request->data['user_id'])->where('movie_id', $request->data['movie_id'])->first();
        if ($rating->id)
            return $this->service->updateModel($request->validated('data'), $rating->id);
        else
            return $this->service->createModel($request->validated('data'));

    }

    /**
     * @OA\Get(
     *   path="/api/rating/{rating_id}",
     *   summary="Show a Rating from his Id",
     *   description="Show a Rating from his Id",
     *   operationId="showRating",
     *   tags={"Ratings"},
     *   @OA\Parameter(ref="#/components/parameters/Rating--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Rating"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="Rating not found"),
     * )
     *
     * @param $crudgeneratorId
     * @return array|Builder|Collection|Rating
     * @throws Throwable
     */
    public function show($crudgeneratorId): array |Builder|Collection|Rating
    {
        return $this->service->getModelById($crudgeneratorId);
    }

    /**
     * @OA\Patch(
     *   operationId="updateRating",
     *   summary="Update an existing Rating",
     *   description="Update an existing Rating",
     *   tags={"Ratings"},
     *   path="/api/rating/{rating_id}",
     *   @OA\Parameter(ref="#/components/parameters/Rating--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Rating"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="Rating not found"),
     *   @OA\RequestBody(
     *     description="Rating to update",
     *     required=true,
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *        @OA\Property(
     *        title="data",
     *        property="data",
     *        type="object",
     *        ref="#/components/schemas/Rating")
     *      )
     *     )
     *   )
     *
     * )
     *
     * @param UpdateRatingRequest $request
     * @param int $crudgeneratorId
     * @return array|Builder|Builder[]|Collection|Rating|Rating[]
     * @throws Throwable
     */
    public function update(UpdateRatingRequest $request, int $crudgeneratorId): array |Rating|Collection|Builder
    {
        return $this->service->updateModel($request->validated('data'), $crudgeneratorId);
    }

    /**
     * @OA\Delete(
     *  path="/api/rating/{rating_id}",
     *  summary="Delete a Rating",
     *  description="Delete a Rating",
     *  operationId="destroyRating",
     *  tags={"Ratings"},
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Rating"
     *       ),
     *     ),
     *   ),
     *  @OA\Parameter(ref="#/components/parameters/Rating--id"),
     *  @OA\Response(response=204,description="No content"),
     *  @OA\Response(response=404,description="Rating not found"),
     * )
     *
     * @param int $crudgeneratorId
     * @return array|Builder|Builder[]|Collection|Rating|Rating[]
     * @throws Throwable
     */
    public function destroy(int $crudgeneratorId): array |Builder|Collection|Rating
    {
        return $this->service->deleteModel($crudgeneratorId);
    }
}