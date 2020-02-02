<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class CheckAccountLoginMiddle
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
        if(Session::has('account') == true) {
            if($request->path() == 'account/login')
                return redirect('/account/isLogin');
                //return redirect('/application/create');
            return $next($request);
        } else if($request->path() == 'account/login') {
            return $next($request);
        }

        return redirect('/account/isLogin');
    }
}
