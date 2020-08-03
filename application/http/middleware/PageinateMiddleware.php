<?php

namespace app\http\middleware;

class PageinateMiddleware
{
    public function handle($request, \Closure $next)
    {
        if (!isset($request->limit)) {
            $request->limit = 10;
        }
        return $next($request);
    }
}
