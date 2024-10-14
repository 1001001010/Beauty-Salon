<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class IsAdmin
{
    /**
     * Мидлвар проверки на админа
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user() and  Auth::user()->role == 'admin') {
            return $next($request);
        }

        return redirect()->back();
    }
}
