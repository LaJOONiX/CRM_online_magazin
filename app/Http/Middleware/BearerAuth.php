<?php

namespace App\Http\Middleware;

use App\Models\Employee;
use Closure;
use Illuminate\Http\Request;

class BearerAuth
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
        // check auth
        $api_token = $request->bearerToken();

        if(!$api_token) {
            return response()->json([
                "status" => false,
                "error" => "Access denied",
            ], 401);
        }

        $employee = Employee::where('api_token',$api_token)->first();

        if(!$employee) {
            return response()->json([
                "status" => false,
                "error" => "Access denied",
            ], 401);
        }

        return $next($request);
    }
}
