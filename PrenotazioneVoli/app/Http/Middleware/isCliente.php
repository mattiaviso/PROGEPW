<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isCliente
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ((!isset($_SESSION['ruolo'])) || ($_SESSION['ruolo'] != 'cliente')) {
            return response()->view('errors.noAuth');
        }
        return $next($request);
    }
}
