<?php

namespace Src\Shared\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

abstract class CustomController extends Controller
{

    /**
     * jsonResponse
     *
     */
    protected function jsonResponse(
        int $status,
        bool $error,
        array|string|int|bool $response
    ): JsonResponse {
        return response()->json([
            'status' => $status,
            'error' => $error,
            'message' => $response
        ]);
    }
}
