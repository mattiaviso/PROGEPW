<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isClienteOrVolo
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ((!isset($_SESSION['ruolo'])) || (($_SESSION['ruolo'] != 'cliente') && ($_SESSION['ruolo'] != 'inserimento'))) {


            if (!isset($_SESSION)) {
                session_start();
            }

            if (!isset($_SESSION['ruolo']) || empty($_SESSION['ruolo'])) {
                $_SESSION['ruolo'] = 'visitor';
            }

        }
        return $next($request);
    }
}
