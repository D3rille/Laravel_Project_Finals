<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserMiddleware
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
        // role =1 is admin, role=0 is normal user
        if(Auth::check()){
            if(Auth::user()->role == "0"){
                return $next($request);
            } else{
                return redirect('/admin/userManagement')->with('message', 'Access denied, this route is only for regular user accounts');
            }

        }else{
            return redirect('/login')->with('message', 'Login to acces the website');
        }
        return $next($request);
    }
}
