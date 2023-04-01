<?php

namespace Src\Management\Forgot\Infrastructure\Controllers;

use Illuminate\Http\Request;
use Src\Management\Forgot\Application\Mail\UserForgotPasswordUseCase;
use Src\Shared\Infrastructure\Controllers\CustomController;
use Src\Shared\Infrastructure\Helper\HttpCodesHelper;

final class UserForgotPasswordController extends CustomController
{
    use HttpCodesHelper;

    public function __construct(
        private readonly UserForgotPasswordUseCase $userForgotPasswordUseCase
    ) {
    }
    public function __invoke(Request $request)
    {
        $response = $this->userForgotPasswordUseCase->__invoke($request->toArray());
        return $this->jsonResponse(
            $this->ok(),
            false,
            $response->entity(),
        );
    }
}