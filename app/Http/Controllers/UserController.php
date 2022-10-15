<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Throwable;
use App\Constants\UserRole;
use App\Dtos\ApiResponse;

/**
 * Class UserControllerController
 * @package  App\Http\Controllers
 */
class UserController extends Controller
{
    private UserService $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *  path="/api/user",
     *  operationId="indexUser",
     *  tags={"Users"},
     *  summary="Get list of User",
     *  description="Returns list of User",
     *  @OA\Response(response=200, description="Successful operation",
     *    @OA\JsonContent(ref="#/components/schemas/Users"),
     *  ),
     * )
     *
     * Display a listing of User.
     * @return LengthAwarePaginator
     * @throws Throwable
     */
    public function index(): LengthAwarePaginator
    {
        return $this->service->paginatedList();
    }

    /**
     * @OA\Post(
     *  operationId="storeUser",
     *  summary="Insert a new User",
     *  description="Insert a new User",
     *  tags={"Users"},
     *  path="/api/user",
     *  @OA\RequestBody(
     *    description="User to create",
     *    required=true,
     *    @OA\MediaType(
     *      mediaType="application/json",
     *      @OA\Schema(
     *      @OA\Property(
     *      title="data",
     *      property="data",
     *      type="object",
     *      ref="#/components/schemas/User")
     *     )
     *    )
     *  ),
     *  @OA\Response(response="201",description="User created",
     *     @OA\JsonContent(
     *      @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/User"
     *      ),
     *    ),
     *  ),
     *  @OA\Response(response=422,description="Validation exception"),
     * )
     *
     * @param StoreUserRequest $request
     * @return array|Builder|Collection|User|Builder[]|User[]
     * @throws Throwable
     */
    public function store(StoreUserRequest $request): array |Builder|Collection|User
    {
        return $this->service->createModel($request->validated());

    }

    /**
     * @OA\Get(
     *   path="/api/user/{user_id}",
     *   summary="Show a User from his Id",
     *   description="Show a User from his Id",
     *   operationId="showUser",
     *   tags={"Users"},
     *   @OA\Parameter(ref="#/components/parameters/User--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/User"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="User not found"),
     * )
     *
     * @param $userId
     * @return array|Builder|Collection|User
     * @throws Throwable
     */
    public function show($userId): array |Builder|Collection|User
    {
        return $this->service->getModelById($userId);
    }

    /**
     * @OA\Patch(
     *   operationId="updateUser",
     *   summary="Update an existing User",
     *   description="Update an existing User",
     *   tags={"Users"},
     *   path="/api/user/{user_id}",
     *   @OA\Parameter(ref="#/components/parameters/User--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/User"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="User not found"),
     *   @OA\RequestBody(
     *     description="User to update",
     *     required=true,
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *        @OA\Property(
     *        title="data",
     *        property="data",
     *        type="object",
     *        ref="#/components/schemas/User")
     *      )
     *     )
     *   )
     *
     * )
     *
     * @param UpdateUserRequest $request
     * @param int $userId
     * @return array|Builder|Builder[]|Collection|User|User[]
     * @throws Throwable
     */
    public function update(UpdateUserRequest $request, int $userId): array |User|Collection|Builder
    {
        return $this->service->updateModel($request->validated(), $userId);
    }

    /**
     * @OA\Delete(
     *  path="/api/user/{user_id}",
     *  summary="Delete a User",
     *  description="Delete a User",
     *  operationId="destroyUser",
     *  tags={"Users"},
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/User"
     *       ),
     *     ),
     *   ),
     *  @OA\Parameter(ref="#/components/parameters/User--id"),
     *  @OA\Response(response=204,description="No content"),
     *  @OA\Response(response=404,description="User not found"),
     * )
     *
     * @param int $userId
     * @return array|Builder|Builder[]|Collection|User|User[]
     * @throws Throwable
     */
    public function destroy(int $userId): array |Builder|Collection|User
    {
        return $this->service->deleteModel($userId);
    }


    /**
     * @OA\Get(
     *   path="/api/role",
     *   summary="Show a role list",
     *   description="Show a role list",
     *   operationId="showRole",
     *   tags={"Role"},
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *     ),
     *   ),
     *   @OA\Response(response="404",description="User not found"),
     * )
     *
     * @return JsonResponse
     * @throws Throwable
     */
    public function roles(): JsonResponse
    {
        $role = new UserRole();
        return ApiResponse::success($role->getRoleList());
    }


}