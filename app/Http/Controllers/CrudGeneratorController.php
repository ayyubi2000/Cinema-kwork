<?php
namespace App\Http\Controllers;

use Throwable;
use App\Models\CrudGenerator;
use App\Services\CrudGeneratorService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Requests\StoreCrudGeneratorRequest;
use App\Http\Requests\UpdateCrudGeneratorRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class CrudGeneratorControllerController
 * @package  App\Http\Controllers
 */
class CrudGeneratorController extends Controller
{
    private CrudGeneratorService $service;

    public function __construct(CrudGeneratorService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *  path="/api/crudgenerators",
     *  operationId="indexCrudGenerator",
     *  tags={"CrudGenerators"},
     *  summary="Get list of CrudGenerator",
     *  description="Returns list of CrudGenerator",
     *  @OA\Response(response=200, description="Successful operation",
     *    @OA\JsonContent(ref="#/components/schemas/CrudGenerator"),
     *  ),
     * )
     *
     * Display a listing of CrudGenerator.
     * @return LengthAwarePaginator
     * @throws Throwable
     */
    public function index(Request $request): LengthAwarePaginator
    {
        return $this->service->paginatedList([], $request->has('all'));
    }

    /**
     * @OA\Post(
     *  operationId="storeCrudGenerator",
     *  summary="Insert a new CrudGenerator",
     *  description="Insert a new CrudGenerator",
     *  tags={"CrudGenerators"},
     *  path="/api/crudgenerators",
     *  @OA\RequestBody(
     *    description="CrudGenerator to create",
     *    required=true,
     *    @OA\MediaType(
     *      mediaType="application/json",
     *      @OA\Schema(
     *      @OA\Property(
     *      title="data",
     *      property="data",
     *      type="object",
     *      ref="#/components/schemas/CrudGenerator")
     *     )
     *    )
     *  ),
     *  @OA\Response(response="201",description="CrudGenerator created",
     *     @OA\JsonContent(
     *      @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/CrudGenerator"
     *      ),
     *    ),
     *  ),
     *  @OA\Response(response=422,description="Validation exception"),
     * )
     *
     * @param StoreCrudGeneratorRequest $request
     * @return array|Builder|Collection|CrudGenerator|Builder[]|CrudGenerator[]
     * @throws Throwable
     */
    public function store(StoreCrudGeneratorRequest $request): array |Builder|Collection|CrudGenerator
    {
        return $this->service->createModel($request->validated('data'));

    }

    /**
     * @OA\Get(
     *   path="/api/crudgenerators/{crudgenerator_id}",
     *   summary="Show a CrudGenerator from his Id",
     *   description="Show a CrudGenerator from his Id",
     *   operationId="showCrudGenerator",
     *   tags={"CrudGenerators"},
     *   @OA\Parameter(ref="#/components/parameters/CrudGenerator--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/CrudGenerator"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="CrudGenerator not found"),
     * )
     *
     * @param $crudgeneratorId
     * @return array|Builder|Collection|CrudGenerator
     * @throws Throwable
     */
    public function show($crudgeneratorId): array |Builder|Collection|CrudGenerator
    {
        return $this->service->getModelById($crudgeneratorId);
    }

    /**
     * @OA\Patch(
     *   operationId="updateCrudGenerator",
     *   summary="Update an existing CrudGenerator",
     *   description="Update an existing CrudGenerator",
     *   tags={"CrudGenerators"},
     *   path="/api/crudgenerators/{crudgenerator_id}",
     *   @OA\Parameter(ref="#/components/parameters/CrudGenerator--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/CrudGenerator"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="CrudGenerator not found"),
     *   @OA\RequestBody(
     *     description="CrudGenerator to update",
     *     required=true,
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *        @OA\Property(
     *        title="data",
     *        property="data",
     *        type="object",
     *        ref="#/components/schemas/CrudGenerator")
     *      )
     *     )
     *   )
     *
     * )
     *
     * @param UpdateCrudGeneratorRequest $request
     * @param int $crudgeneratorId
     * @return array|Builder|Builder[]|Collection|CrudGenerator|CrudGenerator[]
     * @throws Throwable
     */
    public function update(UpdateCrudGeneratorRequest $request, int $crudgeneratorId): array |CrudGenerator|Collection|Builder
    {
        return $this->service->updateModel($request->validated('data'), $crudgeneratorId);

    }

    /**
     * @OA\Delete(
     *  path="/api/crudgenerators/{crudgenerator_id}",
     *  summary="Delete a CrudGenerator",
     *  description="Delete a CrudGenerator",
     *  operationId="destroyCrudGenerator",
     *  tags={"CrudGenerators"},
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/CrudGenerator"
     *       ),
     *     ),
     *   ),
     *  @OA\Parameter(ref="#/components/parameters/CrudGenerator--id"),
     *  @OA\Response(response=204,description="No content"),
     *  @OA\Response(response=404,description="CrudGenerator not found"),
     * )
     *
     * @param int $crudgeneratorId
     * @return array|Builder|Builder[]|Collection|CrudGenerator|CrudGenerator[]
     * @throws Throwable
     */
    public function destroy(int $crudgeneratorId): array |Builder|Collection|CrudGenerator
    {
        return $this->service->deleteModel($crudgeneratorId);
    }
}