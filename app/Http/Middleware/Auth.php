<?php

namespace MediumSpot\Http\Middleware;

use Closure;

class Auth
{
    /**
     * Create a new filter instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $url = ltrim($request->url(), config('app.url'));
        
        if ($url != 'login' && $url != 'register' ) {
            if (is_null(session('user'))) {
                return redirect('/auth/login'); 
            } 
        }

        return $next($request);
    }
}
