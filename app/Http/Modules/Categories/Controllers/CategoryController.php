<?php

namespace App\Http\Modules\Categories\Controllers;


use App\Http\Controllers\Controller;
use App\Http\Modules\Categories\Models\Category;
use App\Http\Modules\Categories\Repositories\CategoryRepository;
use App\Http\Modules\Categories\Requests\CreateOrUpdateCategoryRequest;

class CategoryController extends Controller
{

    public function __construct(
        protected CategoryRepository $categoryRepository
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
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
     * Store a newly created resource in storage.
     */
    public function store(CreateOrUpdateCategoryRequest $request)
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
     * Display the specified resource.
     */
    public function show(int $id)
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
     * Update the specified resource in storage.
     */
    public function update(CreateOrUpdateCategoryRequest $request, int $id)
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
