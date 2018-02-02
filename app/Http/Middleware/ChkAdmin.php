<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class ChkAdmin
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
        $isOnline = Session::get('AdminLoggedIn');
        if($isOnline == null){
            return redirect('admin/login');
        }
        return $next($request);
    }
}
