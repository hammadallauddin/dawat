<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class ChkUser
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
        $isOnline = Session::get('UserLoggedIn');
        if($isOnline == null){
            return redirect('user/login');
        }
        elseif(Session::get('UserLoggedIn')->is_active == 0 || Session::get('UserLoggedIn')->expire < Carbon::now()){
            return response()->view('payments.payment', ['user_name' => $isOnline->username, 'fees' => $isOnline->fees, 'user_id' => $isOnline->id]);
        }
        elseif(Session::get('UserLoggedIn')->is_verified == 0){
            return redirect('user/verify');
        }
        return $next($request);
    }
}
