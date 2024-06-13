<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Cache;

class VerifyTokenApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // protected function guard()
    // {
    //     return auth('');
    // }
    public function handle(Request $request, Closure $next, $guard = null)
    {
        $token = cache::get('auth_token');

        if (!$token) {
            return redirect()->intended();
            // return response()->json(['error' => 'Token tidak valid'], 401);
        }

        // $cachedToken = Cache::remember("{$token}", 600, function () use ($token) {
        //     return $this->guard()->getProvider()->retrieveByCredentials(['id' => $token]);
        // });

        // if (!$cachedToken) {
        //     return response()->json(['error' => 'Token tidaka valid'], 401);
        // }

        // request()->setUser($token);

        // return $next($request);
        return $next($request);
    }
}
