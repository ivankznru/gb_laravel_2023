<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\Soc\LoginController as SocAuthController;

class CheckSocAuthDriver
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
        $socialiteDriver=$request->route('socialiteDriver');
        if (SocAuthController::isSupported('')) {
            return SocAuthController::returnNotSupported($socialiteDriver);
        }
        return $next($request);
    }
}
