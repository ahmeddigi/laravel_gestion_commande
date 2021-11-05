<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


use Closure;
use Illuminate\Http\Request;

class AhmedAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        
        if ($request->bearerToken()) {
            $id = explode("id", $request->bearerToken())[1];
            $user = User::where('id',$id) -> first();
            if ($user->token == $request->bearerToken()) {
                Auth::login($user);
            }
        }
        else {
            return response()->json('Please enter valid type');
        }

        return $next($request);
    }
}
