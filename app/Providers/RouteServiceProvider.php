<?php
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        app(Router::class)->pushMiddlewareToGroup('web', function (Request $request, Closure $next) {
            // 🔥 This runs on every web route
            dd([
                'query_params' => $request->query(),
                'route_params' => $request->route()?->parameters(),
                'full_url' => $request->fullUrl(),
            ]);

            return $next($request);
        });

        Route::middleware('web')
            ->group(base_path('routes/web.php'));
    }
}

