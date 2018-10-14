<?php

namespace App\Http\Middleware;

use Closure;

use App\Guest;

class VerifyGuestToken
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
        $token = filterTokenValue($request->cookie('token', ''));
        $guest = Guest::byPublicToken($token)->first();

        if (!$guest) {
            return response()->json([
                'errors' => [],
                'message' => 'Unauthorized access',
            ], 401);
        }

        return $next($request);
    }
}
