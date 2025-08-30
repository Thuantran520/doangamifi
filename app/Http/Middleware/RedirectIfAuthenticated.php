<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            // Log để debug: biết khi nào middleware chạy và user nào
            logger()->info('RedirectIfAuthenticated triggered', [
                'user_id' => Auth::id(),
                'fullUrl' => $request->fullUrl(),
                'intended' => $request->session()->get('url.intended')
            ]);

            // Dùng route('launcher') hoặc redirect('/') để chắc chắn về launcher

            return redirect('/'); 
        }

        return $next($request);
    }
}
