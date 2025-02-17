<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PreventBack
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Set cache control headers to prevent back navigation
        return $response->header('Cache-Control', 'nocache, no-store, max-age=0,must-revalidate')
                        ->header('Pragma', 'no-cache')
                        ->header('Expires', 'Sat, 26 Jul 1997 05:00:00 GMT');
    }
}
