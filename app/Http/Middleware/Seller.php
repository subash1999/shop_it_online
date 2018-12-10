<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class Seller
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
        /*if(Auth::check()){
            if(Auth::user()->isSeller()){
                return $next($request);        
            }
            else{
                abort(403);
            }
        }
        else{
            abort(403);
        }
*/       
        $user = User::ofType('seller')->first();
        Auth::loginUsingId($user->user_id);
        return $next($request);  
    }
}
