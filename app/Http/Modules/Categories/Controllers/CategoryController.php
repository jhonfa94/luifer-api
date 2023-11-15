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
                'data' => $this->categoryRepository->list(),
                'message' => 'ok'
            ], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'data' => null,
                'message' => 'Error al obtener los datos ', $th->getMessage()
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
                'data' =>  $this->categoryRepository->save(new Category($request->all())),
                'message' => 'Categoria creada correctamente'
            ], 201);
        } catch (\Throwable $e) {

            return response()->json([
                'data' =>  null,
                'message' => 'Error al crear la categoria ' .  $e
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
                    'data' => null,
                    'message' => 'La categoria no existe'
                ], 404);

            return response()->json([
                'data' => $category,
                'message' => 'ok'
            ], 200);
        } catch (\Throwable $th) {
            //throw $th;
            // return [$th->getMessage(), $th->getFile()];
            return response()->json([
                'data' => null,
                'message' => 'Error al obtener los datos ', $th->getMessage()
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
                    'data' => null,
                    'message' => 'La categoria no existe'
                ], 404);

            return response()->json([
                'data' => $this->categoryRepository->save($category->fill($request->all())),
                'message' => 'Categoria actualizada con exito'
            ], 200);



        } catch (\Throwable $e) {

            return response()->json([
                'data' => null,
                'message' => 'Error al actualizar', $e->getMessage()
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
