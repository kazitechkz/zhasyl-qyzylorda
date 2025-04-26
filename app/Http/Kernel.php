<?php

namespace App\Http;

use App\Http\Middleware\AccessMiddleware;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\AgronomistMiddleware;
use App\Http\Middleware\AgronomMiddleware;
use App\Http\Middleware\BeforeSessionFlush;
use App\Http\Middleware\BrigadierMiddleware;
use App\Http\Middleware\ChefMiddleware;
use App\Http\Middleware\ConsumerMiddleware;
use App\Http\Middleware\EnsureUserPermission;
use App\Http\Middleware\MayorMiddleware;
use App\Http\Middleware\ModeratorMiddleware;
use App\Models\GeoPosition;
use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array<int, class-string|string>
     */
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\TrustProxies::class,
        \Illuminate\Http\Middleware\HandleCors::class,
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            BeforeSessionFlush::class
        ],

        'api' => [
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            \Illuminate\Routing\Middleware\ThrottleRequests::class . ':api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * The application's middleware aliases.
     *
     * Aliases may be used instead of class names to conveniently assign middleware to routes and groups.
     *
     * @var array<string, class-string|string>
     */
    protected $middlewareAliases = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'auth.session' => \Illuminate\Session\Middleware\AuthenticateSession::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed' => \App\Http\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'AdminMiddleware' => AdminMiddleware::class,
        'ModerMiddleware' => ModeratorMiddleware::class,
        'MayorMiddleware' => MayorMiddleware::class,
        "AgronomMiddleware" => AgronomMiddleware::class,
        "ConsumerMiddleware" => ConsumerMiddleware::class,
        "ChefMiddleware" => ChefMiddleware::class,
        "AgronomistMiddleware" => AgronomistMiddleware::class,
        "BrigadierMiddleware" => BrigadierMiddleware::class,
        "EnsureUserPermission" => EnsureUserPermission::class,
        "AccessToken" => AccessMiddleware::class
    ];

    public function terminate($request, $response): void
    {

    }
}
