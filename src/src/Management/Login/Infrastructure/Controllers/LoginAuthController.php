<?php

namespace Src\Management\Login\Infrastructure\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Src\Shared\Infrastructure\Helper\HttpCodesHelper;
use Src\Shared\Infrastructure\Controllers\CustomController;
use Src\Management\Login\Application\Login\LoginAuthUserCase;
use Src\Shared\Infrastructure\Middleware\RoleMiddleware;

final class LoginAuthController extends CustomController
{
    use HttpCodesHelper;

    public function __construct(private LoginAuthUserCase $loginCase)
    {
        $this->middleware(RoleMiddleware::class, [
            'roles' => 'super_admin'
        ]);
    }
    public function __invoke(Request $request): JsonResponse
    {
        $response =  $this->jsonResponse(
            200,
            false,
            $this->loginCase->__invoke($request->toArray())->entity()
        );
        return $response;
    }
}