<?php

namespace App\Http\Controllers;

use Throwable;
use App\Dtos\ApiResponse;
use OpenApi\Annotations as OA;
use App\Services\ApiAuthService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ResetPasswordRequest;

class AuthController extends Controller
{
    private ApiAuthService $service;

    public function __construct(ApiAuthService $service)
    {
        $this->service = $service;
    }

    /**
     * Login api
     *
     * @param LoginRequest $request
     * @return JsonResponse
     *
     * Store a newly created resource in storage.
     *
     * @OA\Post(
     *  operationId="login",
     *  summary="Insert a new User",
     *  description="Insert a new User",
     *  tags={"login"},
     *  path="login",
     *  security={
     *      {"bearer_token":{}},
     *  },
     *  @OA\Parameter(
     *    name="email",
     *    in="query",
     *    description="insert your email",
     *    required=true,
     *  ),
     *  @OA\Parameter(
     *    name="password",
     *    in="query",
     *    description="insert your password",
     *    required=true,
     *  ),
     *  @OA\Response(response="200",description="User created",
     *     @OA\JsonContent(
     *      @OA\Property(
     *       property="data",
     *       type="object",
     *      ),
     *    ),
     *  ),
     *  @OA\Response(response=422,description="Validation exception"),
     *  @OA\Response(response="401",description="Unauthorized"),
     * )
     * @throws Throwable
     */
    public function login(LoginRequest $request): JsonResponse
    {
        return $this->service->login($request->validated());
    }



    /**
     * Login api
     *
     * @param RegisterRequest $request
     * @return JsonResponse
     *
     * Store a newly created resource in storage.
     *
     * @OA\Post(
     *  operationId="register",
     *  summary="Insert a new User",
     *  description="Insert a new User",
     *  tags={"login"},
     *  path="register",
     *  security={
     *      {"bearer_token":{}},
     *  },
     *  @OA\Parameter(
     *    name="email",
     *    in="query",
     *    description="insert your email",
     *    required=true,
     *  ),
     *  @OA\Parameter(
     *    name="password",
     *    in="query",
     *    description="insert your password",
     *    required=true,
     *  ),
     *  @OA\Response(response="200",description="User created",
     *     @OA\JsonContent(
     *      @OA\Property(
     *       property="data",
     *       type="object",
     *      ),
     *    ),
     *  ),
     *  @OA\Response(response=422,description="Validation exception"),
     *  @OA\Response(response="401",description="Unauthorized"),
     * )
     * @throws Throwable
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        return $this->service->register($request->validated());
    }

    /**
     * Login api
     *
     * @param ResetPasswordRequest $request
     * @return JsonResponse
     *
     * Store a newly created resource in storage.
     *
     * @OA\Post(
     *  operationId="resetPassword",
     *  summary="resetPassword",
     *  description="resetPassword",
     *  tags={"login"},
     *  path="reset-password",
     *  security={
     *      {"bearer_token":{}},
     *  },
     *  @OA\Parameter(
     *    name="email",
     *    in="query",
     *    description="insert your email",
     *    required=true,
     *  ),
     *  @OA\Parameter(
     *    name="code",
     *    in="query",
     *    description="insert your code",
     *    required=true,
     *  ),
     *  @OA\Response(response="200",description="User created",
     *     @OA\JsonContent(
     *      @OA\Property(
     *       property="data",
     *       type="object",
     *      ),
     *    ),
     *  ),
     *  @OA\Response(response=422,description="Validation exception"),
     *  @OA\Response(response="401",description="Unauthorized"),
     * )
     * @throws Throwable
     */
    public function resetPassword(ResetPasswordRequest $request): JsonResponse
    {
        return $this->service->resetPassword($request->validated());
    }

    /**
     * @OA\Get(
     *  path="logout",
     *  operationId="logout",
     *  tags={"login"},
     *  summary="logout ",
     *  description="account logout",
     *  security={
     *      {"passport":{}},
     *  },
     *  @OA\Response(response="200",description="User created",
     *     @OA\JsonContent(
     *      @OA\Property(
     *       property="data",
     *       type="object",
     *      ),
     *    ),
     *  ),
     *  @OA\Response(response="401",description="Unauthorized"),
     * )
     * Display a listing of the resource.
     *
     * @throws Throwable
     */
    public function logout(): JsonResponse
    {
        return ApiResponse::success($this->service->logout());
    }


    /**
     * @OA\Get(
     *  path="check-user-token",
     *  operationId="checkUserToken",
     *  tags={"login"},
     *  summary="account",
     *  description="user account description",
     *  security={
     *      {"passport":{}},
     *  },
     *  @OA\Response(response="200",description="User created",
     *     @OA\JsonContent(
     *      @OA\Property(
     *       property="data",
     *       type="object",
     *      ),
     *    ),
     *  ),
     *  @OA\Response(response="401",description="Unauthorized"),
     * )
     * Display a listing of the resource.
     *
     */
    public function checkUserToken(): JsonResponse
    {
        $success = Auth()->user();
        return ApiResponse::success($success);
    }

}