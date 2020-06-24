<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class CheckAdmin
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
        $userLogged = Session::get('user');
        if ($userLogged == null) {
            return redirect('/login');
        }
        if (session('permission') == 1) {
            return $next($request);
        }else{
            return redirect('/access-denied');
        }
       // return redirect()->route('home');
    }
}
