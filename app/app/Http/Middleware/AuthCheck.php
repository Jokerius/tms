<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Token;

class AuthCheck
{

    public function handle($request, Closure $next)
    {           
        if(!$request->header('auth-token')){
            return response()->json('Access Denied', 403);
        }
        
        $token = Token::where('token', $request->header('auth-token'))->first();

        if(!$token){
            return response()->json('Access Denied', 403);
        }

        if($token->access == Token::READ_ACCESS && $request->method() != 'GET'){
            return response()->json('Access Denied', 403);            
        }
        
        return $next($request);        
    }
}
