<?php
namespace App\Http\Controllers;

use Throwable;
use App\Models\EmailVerificationCode;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Request;
use App\Services\EmailVerificationCodeService;
use App\Http\Requests\CheckEmailVerificationCodeRequest;
use App\Http\Requests\StoreEmailVerificationCodeRequest;
use App\Http\Requests\UpdateEmailVerificationCodeRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;


class EmailVerificationCodeController extends Controller
{
    private EmailVerificationCodeService $service;

    public function __construct(EmailVerificationCodeService $service)
    {
        $this->service = $service;
    }
    /**
     * @OA\Post(
     *  operationId="storeEmailVerificationCode",
     *  summary="Insert a new EmailVerificationCode",
     *  description="Insert a new EmailVerificationCode",
     *  tags={"login"},
     *  path="/api/emailverificationcode",
     *  @OA\RequestBody(
     *    description="EmailVerificationCode to create",
     *    required=true,
     *    @OA\MediaType(
     *      mediaType="application/json",
     *      @OA\Schema(
     *      @OA\Property(
     *      title="data",
     *      property="data",
     *      type="object",
     *      ref="#/components/schemas/EmailVerificationCode")
     *     )
     *    )
     *  ),
     *  @OA\Response(response="201",description="EmailVerificationCode created",
     *     @OA\JsonContent(
     *      @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/EmailVerificationCode"
     *      ),
     *    ),
     *  ),
     *  @OA\Response(response=422,description="Validation exception"),
     * )
     *
     * @param StoreEmailVerificationCodeRequest $request
     * @return array|Builder|Collection|EmailVerificationCode|Builder[]|EmailVerificationCode[]
     * @throws Throwable
     */
    public function sendEmailVerification(StoreEmailVerificationCodeRequest $request): array |Builder|Collection|EmailVerificationCode
    {
        return $this->service->createModel($request->validated('data'));
    }


    /**
     * @OA\Get(
     *   path="/api/emailverificationcode/{emailverificationcode_id}",
     *   summary="Show a EmailVerificationCode from his Id",
     *   description="Show a EmailVerificationCode from his Id",
     *   operationId="showEmailVerificationCode",
     *   tags={"login"},
     *   @OA\Parameter(ref="#/components/parameters/EmailVerificationCode--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/EmailVerificationCode"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="EmailVerificationCode not found"),
     * )
     *
     * @param $crudgeneratorId
     * @throws Throwable
     */
    public function checkEmailVerification(CheckEmailVerificationCodeRequest $request)
    {
        return $this->service->checkVerificationCode($request->validated('data'));
    }

}