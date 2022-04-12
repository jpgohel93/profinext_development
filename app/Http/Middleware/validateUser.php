<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class isLoggedIn
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
        if (Auth::check()) {
            if (User::where(["id" => Auth::id(), "role_id" => "1", "deleted_at" => null, "status" => "1"])->exists()) {
                return $next($request);
            }
            return Redirect::route("logout")->with("info", "Session Expire");
        }
        return Redirect::route("login")->with("error", "Session Expire");
    }
}
