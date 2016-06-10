<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('login');
            }
        }

        $user_id = \Auth::User()->id;

        if ((int)User::where('id', $user_id)->first(['status'])->status === 0) {
            return response('U bent geblokkeerd. Neem contact op met de beheerder of wacht tot uw blokkering voorbij is.', 403);
        }

        return $next($request);
    }
}
