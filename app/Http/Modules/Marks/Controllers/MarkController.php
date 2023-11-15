<?php

namespace App\Http\Modules\Marks\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Modules\Marks\Models\Mark;
use App\Http\Modules\Marks\Repositories\MarkRepository;
use App\Http\Modules\Marks\Requests\CreateOrUpdateMarkRequest;

class MarkController extends Controller
{
    public function __construct(
        protected MarkRepository $markRepository
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
     * Store a newly created resource in storage.
     */
    public function store(CreateOrUpdateMarkRequest $request)
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
     * Display the specified resource.
     */
    public function show(int $id)
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
     * Update the specified resource in storage.
     */
    public function update(CreateOrUpdateMarkRequest $request, int $id)
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mark $mark)
    {
        //
    }
}
