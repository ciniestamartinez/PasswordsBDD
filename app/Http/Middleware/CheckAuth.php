<?php

namespace App\Http\Middleware;
use App\Helpers\Token;
use App\User;

use Closure;

class CheckAuth
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
        $token_header = $request->header('Authorization');
        $token = new Token();
        try{
            $user_email = $token->decode($token_header);
            $user_email->email;
        }catch (\Throwable $th){
            return response()->json([
                "error" => "Token no válido"]);
        }
        
        $user = User::where('email', '=', $user_email)->first();

        if($user != null)
        {
            return $next($request);
        }
       
    }
}
