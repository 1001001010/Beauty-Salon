<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class IsMaster
{
    /**
     * Мидлвар проверки на мастера
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user() and  Auth::user()->role == 'master') {
            return $next($request);
        }

        return redirect()->back();
    }
}
