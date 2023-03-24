<?php

namespace Src\Shared\Infrastructure\Middleware;

use Closure;
use Illuminate\Http\Request;
use Src\Management\Login\Application\Auth\LoginCheckAuthenticationUseCase;
use Src\Shared\Infrastructure\Exeptions\AuthException;
use Src\Shared\Infrastructure\Helper\HttpCodesHelper;

final class AuthMiddleware
{

    use HttpCodesHelper;


    public function __construct(
        private readonly LoginCheckAuthenticationUseCase $loginCheckAuthenticationUseCase
    ) {
    }



    public function handle(
        Request $request,
        Closure $next
    ): mixed {
        $token = $request->header('x-token');
        if (!$token) {
            throw new AuthException('You must send the x-token', $this->badRequest());
        }
        $tokenValid = $this->loginCheckAuthenticationUseCase->__invoke($token);
        if (!$tokenValid) {
            throw new AuthException('Invalid token', $this->badRequest());
        }
        return $next($request);
    }
}
