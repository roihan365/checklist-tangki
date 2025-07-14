<?php

namespace App\Http\Controllers;

use App\Http\Resources\HistoriesResource;
use App\Services\HistoriesService;
use Illuminate\Database\Eloquent\ModelNotFoundException;


use Illuminate\Http\Request;

class HistoriesController extends Controller
{
    //
    private HistoriesService $historiesService;

    public function __construct(historiesService $historiesService)
    {
        $this->historiesService = $historiesService;
    }

    public function index()
    {
        $fields = ['id', 'name', 'uploadfile', 'keterangan'];

        $histories = $this->historiesService->getAll($fields ?: ['*']);

        return response()->json(HistoriesResource::collection($histories));
    }

    public function show(int $id)
    {
        try {
            $fields = ['id', 'name', 'uploadfile', 'keterangan'];

            $histories = $this->historiesService->getById($id, $fields);

            return response()->json(new HistoriesResource($histories));
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'histories not found',
            ], 404);
        }
    }

     public function store(HistoriesRequest $request)
    {
        $histories = $this->historiesService->create($request->validated());

        return response()->json(new HistoriesResource($histories), 201);
    }

    public function update(HistoriesRequest $request, int $id)
    {
        try {
            $histories = $this->historiesService->update($id, $request->validated());

            return response()->json(new HistoriesResource($histories));

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'histories not found',
            ], 404);
        }
    }

    public function destroy(int $id)
    {
        try {
            $this->historiesService->delete($id);

            return response()->json([
                'message' => 'histories deleted succesfully'
            ]);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'histories not found',
            ], 404);
        }
    }
}
