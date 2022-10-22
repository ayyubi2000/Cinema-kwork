<?php
namespace App\Http\Controllers;

use Throwable;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class CategoryControllerController
 * @package  App\Http\Controllers
 */
class CategoryController extends Controller
{
    private CategoryService $service;

    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *  path="/api/category",
     *  operationId="indexCategory",
     *  tags={"Categorys"},
     *  summary="Get list of Category",
     *  description="Returns list of Category",
     *  @OA\Response(response=200, description="Successful operation",
     *    @OA\JsonContent(ref="#/components/schemas/Category"),
     *  ),
     * )
     *
     * Display a listing of Category.
     * @return LengthAwarePaginator
     * @throws Throwable
     */
    public function index(Request $request): LengthAwarePaginator|Collection
    {
        return $this->service->paginatedList($request->all());
    }

    /**
     * @OA\Post(
     *  operationId="storeCategory",
     *  summary="Insert a new Category",
     *  description="Insert a new Category",
     *  tags={"Categorys"},
     *  path="/api/category",
     *  @OA\RequestBody(
     *    description="Category to create",
     *    required=true,
     *    @OA\MediaType(
     *      mediaType="application/json",
     *      @OA\Schema(
     *      @OA\Property(
     *      title="data",
     *      property="data",
     *      type="object",
     *      ref="#/components/schemas/Category")
     *     )
     *    )
     *  ),
     *  @OA\Response(response="201",description="Category created",
     *     @OA\JsonContent(
     *      @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Category"
     *      ),
     *    ),
     *  ),
     *  @OA\Response(response=422,description="Validation exception"),
     * )
     *
     * @param StoreCategoryRequest $request
     * @return array|Builder|Collection|Category|Builder[]|Category[]
     * @throws Throwable
     */
    public function store(StoreCategoryRequest $request): array |Builder|Collection|Category
    {
        return $this->service->createModel($request->validated('data'));
    }

    /**
     * @OA\Get(
     *   path="/api/category/{category_id}",
     *   summary="Show a Category from his Id",
     *   description="Show a Category from his Id",
     *   operationId="showCategory",
     *   tags={"Categorys"},
     *   @OA\Parameter(ref="#/components/parameters/Category--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Category"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="Category not found"),
     * )
     *
     * @param $crudgeneratorId
     * @return array|Builder|Collection|Category
     * @throws Throwable
     */
    public function show($crudgeneratorId): array |Builder|Collection|Category
    {
        return $this->service->getModelById($crudgeneratorId, ['subCategories']);
    }

    /**
     * @OA\Patch(
     *   operationId="updateCategory",
     *   summary="Update an existing Category",
     *   description="Update an existing Category",
     *   tags={"Categorys"},
     *   path="/api/category/{category_id}",
     *   @OA\Parameter(ref="#/components/parameters/Category--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Category"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="Category not found"),
     *   @OA\RequestBody(
     *     description="Category to update",
     *     required=true,
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *        @OA\Property(
     *        title="data",
     *        property="data",
     *        type="object",
     *        ref="#/components/schemas/Category")
     *      )
     *     )
     *   )
     *
     * )
     *
     * @param UpdateCategoryRequest $request
     * @param int $crudgeneratorId
     * @return array|Builder|Builder[]|Collection|Category|Category[]
     * @throws Throwable
     */
    public function update(UpdateCategoryRequest $request, int $crudgeneratorId): array |Category|Collection|Builder
    {
        return $this->service->updateModel($request->validated('data'), $crudgeneratorId);

    }

    /**
     * @OA\Delete(
     *  path="/api/category/{category_id}",
     *  summary="Delete a Category",
     *  description="Delete a Category",
     *  operationId="destroyCategory",
     *  tags={"Categorys"},
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Category"
     *       ),
     *     ),
     *   ),
     *  @OA\Parameter(ref="#/components/parameters/Category--id"),
     *  @OA\Response(response=204,description="No content"),
     *  @OA\Response(response=404,description="Category not found"),
     * )
     *
     * @param int $crudgeneratorId
     * @return array|Builder|Builder[]|Collection|Category|Category[]
     * @throws Throwable
     */
    public function destroy(int $crudgeneratorId): array |Builder|Collection|Category
    {
        return $this->service->deleteModel($crudgeneratorId);
    }
}