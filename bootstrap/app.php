<?php

use App\Exceptions\AvailabilityException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\ItemNotFoundException;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        // web: __DIR__.'/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (ItemNotFoundException $e, Request $request) {
            return response()->json([
                'message' => 'Item not found.',
            ], HttpResponse::HTTP_NOT_FOUND);
        });

        $exceptions->render(function (HttpException $e, Request $request) {
            return response()->json([
                'message' => $e->getMessage(),
            ], HttpResponse::HTTP_BAD_REQUEST);
        });

        $exceptions->render(function (AvailabilityException $e, Request $request) {
            return response()->json([
                'message' => $e->getMessage(),
            ], $e->getCode());
        });
    })->create();
