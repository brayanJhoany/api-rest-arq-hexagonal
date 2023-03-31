<?php

namespace Src\Shared\Infrastructure\Middleware;

use Closure;
use Illuminate\Http\Request;
use Src\Management\Login\Application\Login\LoginRoleAuthenticationUseCase;
use Src\Shared\Infrastructure\Exeptions\AuthException;
use Src\Shared\Infrastructure\Helper\HttpCodesHelper;

final class RoleMiddleware
{
    use HttpCodesHelper;


    public function __construct(private readonly LoginRoleAuthenticationUseCase $loginRoleAuthenticationUseCase)
    {
    }

    public function handle(Request $request, Closure $next): mixed
    {
        $token = $request->header('x-token');
        if (!$token) {
            throw new AuthException('You must send the x-token', $this->badRequest());
        }

        $check = $this->loginRoleAuthenticationUseCase->__invoke($token, $request->route()->controller->getMiddleware()[0]['options']['roles'] ?? '*');
        if (!$check) {
            throw new AuthException('You do not have permission to access this resource', $this->badRequest());
        }
        return $next($request);
    }
}