<?php

namespace App\Http\Controllers;

use App\Domain\News\Services\NewsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Throwable;

class NewsController extends Controller
{
    protected NewsService $service;

    public function __construct(NewsService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request): JsonResponse
    {

        return response()->json([
            'data' => $this->service->getAll($request->all()),
        ], Response::HTTP_OK
        );
    }

    public function show($id): JsonResponse
    {
        try {
            $new = $this->service->getById($id);

            return response()->json(['data' => $new], Response::HTTP_OK);
        } catch (Throwable $throwable) {
            $this->badRequestResponse($throwable);
        }

    }
}
