<?php

namespace App\Http\Modules\Products\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Modules\Products\Models\Product;
use App\Http\Modules\Products\Repositories\ProductRepository;
use App\Http\Modules\Products\Requests\CreateOrUpdateProductRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(
        protected ProductRepository $productRepository
    ) {
    }

    /**
     * List Products
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            return response()->json([
                'message' => 'ok',
                'data' => $this->productRepository->list()
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Error, sin datos',
                'data' => null,
            ], 400);
        }
    }

    /**
     * Store Create Product
     *
     * @param CreateOrUpdateProductRequest $request
     * @return JsonResponse
     */
    public function store(CreateOrUpdateProductRequest $request): JsonResponse
    {
        // return $request;
        try {
            return response()->json([
                'message' => 'ok',
                'data' => $this->productRepository->save(new Product($request->all())),
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Error al registrar el producto ' . $e->getMessage(),
                'data' => null,
            ]);
        }
    }

    /**
     * Show Product By Id
     *
     * @param integer $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        try {
            $product = $this->productRepository->getById($id);
            if (!$product)
                return response()->json([
                    'message' => 'El producto no existe',
                    'data' => null,
                ], 404);

            return response()->json([
                'message' => 'ok',
                'data' => $product,
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Error al crear el producto ' .  $e->getMessage(),
                'data' =>  null,
            ], 400);
        }
    }

    /**
     * Update Product By Id
     *
     * @param CreateOrUpdateProductRequest $request
     * @param integer $id
     * @return JsonResponse
     */
    public function update(CreateOrUpdateProductRequest $request, int $id): JsonResponse
    {
        try {
            $product = $this->productRepository->find($id);
            if (!$product)
                return response()->json([
                    'message' => 'El producto no existe',
                    'data' => null,
                ]);

            return response()->json([
                'message' => 'Producto actualizado',
                'data' => $this->productRepository->save($product->fill($request->all())),
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Error al actualizar ' . $e->getMessage(),
                'data' => null
            ], 404);
        }
    }
}
