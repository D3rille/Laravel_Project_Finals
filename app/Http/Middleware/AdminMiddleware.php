<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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
            if(Auth::user()->role == "1"){
                return $next($request);
            } else{
                return redirect('/cropSalesTracker')->with('message', 'Access denied, you are unauthorized for this route.');
            }

        }else{
            return redirect('/login')->with('message', 'Login to acces the website');
        }
        return $next($request);
    }
}
