<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {

        $middleware->alias([
            'authCustom' => \App\Http\Middleware\authCustom::class,
            'isCliente' => \App\Http\Middleware\isCliente::class,
            'isAdmin' => \App\Http\Middleware\isAdmin::class,
            'isAddettoVolo' => \App\Http\Middleware\isAddettoVolo::class,
            'isAddettoPrenotazioni' => \App\Http\Middleware\isAddettoPrenotazioni::class,
            'isClienteOrVolo' => \App\Http\Middleware\isClienteOrVolo::class,
            'lang' => \App\Http\Middleware\language::class,

        ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
