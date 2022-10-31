<?php
namespace App\Http\Controllers;

use Throwable;
use App\Models\Profession;
use App\Services\ProfessionService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Requests\StoreProfessionRequest;
use App\Http\Requests\UpdateProfessionRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class ProfessionControllerController
 * @package  App\Http\Controllers
 */
class ProfessionController extends Controller
{
    private ProfessionService $service;

    public function __construct(ProfessionService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *  path="/api/profession",
     *  operationId="indexProfession",
     *  tags={"Professions"},
     *  summary="Get list of Profession",
     *  description="Returns list of Profession",
     *  @OA\Response(response=200, description="Successful operation",
     *    @OA\JsonContent(ref="#/components/schemas/Profession"),
     *  ),
     * )
     *
     * Display a listing of Profession.
     * @return LengthAwarePaginator
     * @throws Throwable
     */
    public function index(Request $request): LengthAwarePaginator|Collection
    {
        return $this->service->paginatedList($request->all());
    }

    /**
     * @OA\Post(
     *  operationId="storeProfession",
     *  summary="Insert a new Profession",
     *  description="Insert a new Profession",
     *  tags={"Professions"},
     *  path="/api/profession",
     *  @OA\RequestBody(
     *    description="Profession to create",
     *    required=true,
     *    @OA\MediaType(
     *      mediaType="application/json",
     *      @OA\Schema(
     *      @OA\Property(
     *      title="data",
     *      property="data",
     *      type="object",
     *      ref="#/components/schemas/Profession")
     *     )
     *    )
     *  ),
     *  @OA\Response(response="201",description="Profession created",
     *     @OA\JsonContent(
     *      @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Profession"
     *      ),
     *    ),
     *  ),
     *  @OA\Response(response=422,description="Validation exception"),
     * )
     *
     * @param StoreProfessionRequest $request
     * @return array|Builder|Collection|Profession|Builder[]|Profession[]
     * @throws Throwable
     */
    public function store(StoreProfessionRequest $request): array |Builder|Collection|Profession
    {
        return $this->service->createModel($request->validated('data'));

    }

    /**
     * @OA\Get(
     *   path="/api/profession/{profession_id}",
     *   summary="Show a Profession from his Id",
     *   description="Show a Profession from his Id",
     *   operationId="showProfession",
     *   tags={"Professions"},
     *   @OA\Parameter(ref="#/components/parameters/Profession--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Profession"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="Profession not found"),
     * )
     *
     * @param $crudgeneratorId
     * @return array|Builder|Collection|Profession
     * @throws Throwable
     */
    public function show($crudgeneratorId): array |Builder|Collection|Profession
    {
        return $this->service->getModelById($crudgeneratorId);
    }

    /**
     * @OA\Patch(
     *   operationId="updateProfession",
     *   summary="Update an existing Profession",
     *   description="Update an existing Profession",
     *   tags={"Professions"},
     *   path="/api/profession/{profession_id}",
     *   @OA\Parameter(ref="#/components/parameters/Profession--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Profession"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="Profession not found"),
     *   @OA\RequestBody(
     *     description="Profession to update",
     *     required=true,
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *        @OA\Property(
     *        title="data",
     *        property="data",
     *        type="object",
     *        ref="#/components/schemas/Profession")
     *      )
     *     )
     *   )
     *
     * )
     *
     * @param UpdateProfessionRequest $request
     * @param int $crudgeneratorId
     * @return array|Builder|Builder[]|Collection|Profession|Profession[]
     * @throws Throwable
     */
    public function update(UpdateProfessionRequest $request, int $crudgeneratorId): array |Profession|Collection|Builder
    {
        return $this->service->updateModel($request->validated('data'), $crudgeneratorId);

    }

    /**
     * @OA\Delete(
     *  path="/api/profession/{profession_id}",
     *  summary="Delete a Profession",
     *  description="Delete a Profession",
     *  operationId="destroyProfession",
     *  tags={"Professions"},
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Profession"
     *       ),
     *     ),
     *   ),
     *  @OA\Parameter(ref="#/components/parameters/Profession--id"),
     *  @OA\Response(response=204,description="No content"),
     *  @OA\Response(response=404,description="Profession not found"),
     * )
     *
     * @param int $crudgeneratorId
     * @return array|Builder|Builder[]|Collection|Profession|Profession[]
     * @throws Throwable
     */
    public function destroy(int $crudgeneratorId): array |Builder|Collection|Profession
    {
        return $this->service->deleteModel($crudgeneratorId);
    }
}