<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Console\Commands\CleanupExpiredChats;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Gate;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin' => AdminMiddleware::class,
        ]);
        $middleware->api(prepend: [
            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
        ]);
    })
    // ->withProviders([
    //     \Dedoc\Scramble\ScrambleServiceProvider::class,
    // ])
    // ->withBooted(function () {
    //     Gate::define('viewApiDocs', function ($user) {
    //         return $user->role === 'admin';
    //     });
    // })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

$app->command('chats:cleanup', CleanupExpiredChats::class);
