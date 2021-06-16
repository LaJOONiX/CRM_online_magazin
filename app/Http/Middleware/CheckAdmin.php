<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            self::throw_error();
        }
        if (Auth::user()->is_admin == 0) {
            self::throw_error();
        }

        return $next($request);
    }

    private function throw_error() {
        return response()->json([
            "status" => false,
            "error" => "Access denied",
        ], 401);
    }
}
