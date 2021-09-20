<?php

namespace App\Http\Middleware;

use Closure;
use Token;

class AuthCheck
{

    public function handle($request, Closure $next)
    {        
        $token = Token::where('token', $request->header('auth-token'))->first();
        
        if(!$token){
            return response()->json('Access Denied', 403);
        }
        
        if($token->access == Token::READ_ACCESS && $request->method() != 'get'){
            return response()->json('Access Denied', 403);            
        }
        
        return $next($request);        
    }
}
