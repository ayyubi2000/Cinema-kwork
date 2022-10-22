<?php
namespace App\Http\Controllers;

use Throwable;
use App\Models\Country;
use App\Services\CountryService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Requests\StoreCountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class CountryControllerController
 * @package  App\Http\Controllers
 */
class CountryController extends Controller
{
    private CountryService $service;

    public function __construct(CountryService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *  path="/api/country",
     *  operationId="indexCountry",
     *  tags={"Countrys"},
     *  summary="Get list of Country",
     *  description="Returns list of Country",
     *  @OA\Response(response=200, description="Successful operation",
     *    @OA\JsonContent(ref="#/components/schemas/Country"),
     *  ),
     * )
     *
     * Display a listing of Country.
     * @return LengthAwarePaginator
     * @throws Throwable
     */
    public function index(Request $request): LengthAwarePaginator|Collection
    {
        return $this->service->paginatedList($request->all());
    }

    /**
     * @OA\Post(
     *  operationId="storeCountry",
     *  summary="Insert a new Country",
     *  description="Insert a new Country",
     *  tags={"Countrys"},
     *  path="/api/country",
     *  @OA\RequestBody(
     *    description="Country to create",
     *    required=true,
     *    @OA\MediaType(
     *      mediaType="application/json",
     *      @OA\Schema(
     *      @OA\Property(
     *      title="data",
     *      property="data",
     *      type="object",
     *      ref="#/components/schemas/Country")
     *     )
     *    )
     *  ),
     *  @OA\Response(response="201",description="Country created",
     *     @OA\JsonContent(
     *      @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Country"
     *      ),
     *    ),
     *  ),
     *  @OA\Response(response=422,description="Validation exception"),
     * )
     *
     * @param StoreCountryRequest $request
     * @return array|Builder|Collection|Country|Builder[]|Country[]
     * @throws Throwable
     */
    public function store(StoreCountryRequest $request): array |Builder|Collection|Country
    {
        return $this->service->createModel($request->validated('data'));

    }

    /**
     * @OA\Get(
     *   path="/api/country/{country_id}",
     *   summary="Show a Country from his Id",
     *   description="Show a Country from his Id",
     *   operationId="showCountry",
     *   tags={"Countrys"},
     *   @OA\Parameter(ref="#/components/parameters/Country--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Country"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="Country not found"),
     * )
     *
     * @param $crudgeneratorId
     * @return array|Builder|Collection|Country
     * @throws Throwable
     */
    public function show($crudgeneratorId): array |Builder|Collection|Country
    {
        return $this->service->getModelById($crudgeneratorId, ['regions']);
    }

    /**
     * @OA\Patch(
     *   operationId="updateCountry",
     *   summary="Update an existing Country",
     *   description="Update an existing Country",
     *   tags={"Countrys"},
     *   path="/api/country/{country_id}",
     *   @OA\Parameter(ref="#/components/parameters/Country--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Country"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="Country not found"),
     *   @OA\RequestBody(
     *     description="Country to update",
     *     required=true,
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *        @OA\Property(
     *        title="data",
     *        property="data",
     *        type="object",
     *        ref="#/components/schemas/Country")
     *      )
     *     )
     *   )
     *
     * )
     *
     * @param UpdateCountryRequest $request
     * @param int $crudgeneratorId
     * @return array|Builder|Builder[]|Collection|Country|Country[]
     * @throws Throwable
     */
    public function update(UpdateCountryRequest $request, int $crudgeneratorId): array |Country|Collection|Builder
    {
        return $this->service->updateModel($request->validated('data'), $crudgeneratorId);

    }

    /**
     * @OA\Delete(
     *  path="/api/country/{country_id}",
     *  summary="Delete a Country",
     *  description="Delete a Country",
     *  operationId="destroyCountry",
     *  tags={"Countrys"},
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Country"
     *       ),
     *     ),
     *   ),
     *  @OA\Parameter(ref="#/components/parameters/Country--id"),
     *  @OA\Response(response=204,description="No content"),
     *  @OA\Response(response=404,description="Country not found"),
     * )
     *
     * @param int $crudgeneratorId
     * @return array|Builder|Builder[]|Collection|Country|Country[]
     * @throws Throwable
     */
    public function destroy(int $crudgeneratorId): array |Builder|Collection|Country
    {
        return $this->service->deleteModel($crudgeneratorId);
    }
}