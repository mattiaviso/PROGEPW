<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ((!isset($_SESSION['ruolo'])) || ($_SESSION['ruolo'] != 'admin')) {
            return response()->view('errors.404', ['message' => 'Solo l\'admin può accedere a questa pagina!']);
        }
        return $next($request);
    }
}
