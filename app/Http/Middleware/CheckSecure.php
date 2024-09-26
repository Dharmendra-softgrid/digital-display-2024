<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class CheckSecure
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ((!$request->secure() || substr($request->header('host'), 0, 4) != 'www.') && App::environment() === 'production') {
            return redirect()->secure($request->getRequestUri());
        }
        return $next($request);
    }
}
