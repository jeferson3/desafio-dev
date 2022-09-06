<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Resources\PaginationResource;
use App\Http\Services\Store\StoreService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiController extends Controller
{

    private StoreService $storeService;

    public function __construct(StoreService $storeService)
    {
        $this->storeService = $storeService;
    }

    /**
     * @OA\Get (
     *     path="/stores",
     *     summary="Transações Lojas",
     *     @OA\Response(response="200", description="Resposta com sucesso"),
     *
     *     tags={"Lojas"},
     *
     *     @OA\Parameter(
     *          name="limit",
     *          in="query",
     *          required=false,
     *          description="pagination - per page",
     *          @OA\Schema(
     *              type="integer"
     *          ),
     *     ),
     *     @OA\Parameter(
     *          name="page",
     *          in="query",
     *          required=false,
     *          description="pagination - page",
     *          @OA\Schema(
     *              type="integer"
     *          ),
     *     ),
     *
     *    )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        return (new PaginationResource(
            $this->storeService
                ->paginate($request->get('limit') ?? 10)
        ))
            ->response();
    }

}
