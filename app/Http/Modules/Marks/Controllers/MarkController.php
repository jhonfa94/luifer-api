<?php

namespace App\Http\Modules\Marks\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Modules\Marks\Models\Mark;
use App\Http\Modules\Marks\Repositories\MarkRepository;
use App\Http\Modules\Marks\Requests\CreateOrUpdateMarkRequest;
use Illuminate\Http\JsonResponse;

class MarkController extends Controller
{
    public function __construct(
        protected MarkRepository $markRepository
    ) {
    }


    /**
     * Get list Marks
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            return response()->json([
                'message' => 'ok',
                'data' => $this->markRepository->list(),
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Error, sin datos',
                'data' => null,
            ], 400);
        }
    }

    /**
     * Store Mark
     *
     * @param CreateOrUpdateMarkRequest $request
     * @return JsonResponse
     */
    public function store(CreateOrUpdateMarkRequest $request): JsonResponse
    {
        try {
            return response()->json([
                'message' => 'ok',
                'data' => $this->markRepository->save(new Mark($request->all()))
            ], 201);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Error al crear la marca ' .  $e->getMessage(),
                'data' =>  null,
            ], 400);
        }
    }

    /**
     * Show Mark By Id
     *
     * @param integer $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        try {
            $mark = $this->markRepository->getById($id);
            if (!$mark)
                return response()->json([
                    'message' => 'La marca no existe',
                    'data' => null
                ], 404);

            return response()->json([
                'message' => 'ok',
                'data' => $mark,
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Error al obtener la marca ' .  $e->getMessage(),
                'data' =>  null,
            ], 400);
        }
    }

    /**
     * Update Mark By Id
     *
     * @param CreateOrUpdateMarkRequest $request
     * @param integer $id
     * @return JsonResponse
     */
    public function update(CreateOrUpdateMarkRequest $request, int $id): JsonResponse
    {
        try {
            $mark = $this->markRepository->find($id);
            if (!$mark)
                return response()->json([
                    'message' => 'La marca no existe',
                    'data' => null
                ], 404);

            return response()->json([
                'message' => 'Marca actualizada con éxito',
                'data' => $this->markRepository->save($mark->fill($request->all()))
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Error al actualizar ' . $e->getMessage(),
                'data' => null
            ], 404);
        }
    }


}
