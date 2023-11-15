<?php

namespace App\Http\Modules\Categories\Controllers;


use App\Http\Controllers\Controller;
use App\Http\Modules\Categories\Models\Category;
use App\Http\Modules\Categories\Repositories\CategoryRepository;
use App\Http\Modules\Categories\Requests\CreateOrUpdateCategoryRequest;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{

    public function __construct(
        protected CategoryRepository $categoryRepository
    ) {
    }

    /**
     * Get List Categories
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            return response()->json([
                'message' => 'ok',
                'data' => $this->categoryRepository->list(),
            ], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'message' => 'Error al obtener los datos ', $th->getMessage(),
                'data' => null,
            ], 400);
        }
    }

    /**
     * Store Category
     *
     * @param CreateOrUpdateCategoryRequest $request
     * @return JsonResponse
     */
    public function store(CreateOrUpdateCategoryRequest $request): JsonResponse
    {
        try {
            return response()->json([
                'message' => 'Categoria creada correctamente',
                'data' =>  $this->categoryRepository->save(new Category($request->all())),
            ], 201);
        } catch (\Throwable $e) {

            return response()->json([
                'message' => 'Error al crear la categoria ' . $e->getMessage(),
                'data' =>  null,
            ], 400);
        }
    }

    /**
     * Show Category By Id
     *
     * @param integer $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        try {
            $category = $this->categoryRepository->getById($id);
            if (!$category)
                return response()->json([
                    'message' => 'La categoria no existe',
                    'data' => null,
                ], 404);

            return response()->json([
                'message' => 'ok',
                'data' => $category,
            ], 200);
        } catch (\Throwable $th) {
            //throw $th;
            // return [$th->getMessage(), $th->getFile()];
            return response()->json([
                'message' => 'Error al obtener los datos ', $th->getMessage(),
                'data' => null,
            ], 400);
        }
    }

    /**
     * Update Category By Id
     *
     * @param CreateOrUpdateCategoryRequest $request
     * @param integer $id
     * @return JsonResponse
     */
    public function update(CreateOrUpdateCategoryRequest $request, int $id): JsonResponse
    {
        try {
            $category = $this->categoryRepository->find($id);
            if (!$category)
                return response()->json([
                    'message' => 'La categoria no existe',
                    'data' => null,
                ], 404);

            return response()->json([
                'message' => 'Categoria actualizada con exito',
                'data' => $this->categoryRepository->save($category->fill($request->all())),
            ], 200);

        } catch (\Throwable $e) {

            return response()->json([
                'message' => 'Error al actualizar: ', $e->getMessage(),
                'data' => null,
            ], 400);

        }
    }


}
