<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Check if the user role matches or if a temporary role is stored in the session
        if (Auth::check() && (Auth::user()->role == $role || $request->session()->get('selected_student_role') == $role)) {
            return $next($request);
        }

        return response()->json(["message" => "You don't have permission to access this page."], 403);
    }
}
