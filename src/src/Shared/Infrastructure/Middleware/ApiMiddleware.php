<?php

namespace Src\Shared\Infrastructure\Middleware;

use Closure;
use Illuminate\Http\Request;
use Src\Shared\Domain\Helper\HttpCodeDomainHelper;
use Src\Shared\Infrastructure\Exeptions\ApiAuthException;

final class ApiMiddleware
{
    use HttpCodeDomainHelper;

    public function handle(
        Request $request,
        Closure $next
    ): mixed {
        if (empty($request->header('Autorization'))) {
            return throw new ApiAuthException('You must send the token', $this->badRequest());
        }

        if ($request->header('Autorization') != env('API_KEY')) {
            return throw new ApiAuthException('Unauthorized', $this->unauthorized());
        }
        return $next($request);
    }
}