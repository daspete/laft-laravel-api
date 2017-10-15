<?php

namespace App\Http\Middleware;

use Closure;

use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class TokenEntrustAbility extends BaseMiddleware{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $roles, $permissions, $validateAll = false)
    {
        if(! $token = $this->auth->setRequest($request)->getToken()){
            return response()->json(array(
                'error' => 'no_token',
            ), 401);
        }

        try{
            $user = $this->auth->parseToken($token)->authenticate();
        }catch(TokenExpiredException $e){
            return response()->json(array(
                'error' => 'token_expired',
            ), 401);
        }catch(JWTException $e){
            return response()->json(array(
                'error' => 'token_invalid',
            ), 401);
        }

        if(!$user){
            return response()->json(array(
                'error' => 'no_user',
            ), 401);
        }

        $validateAll = strpos($validateAll, 'true') !== false ? true : false;

        if(!$request->user()->ability(explode('|', $roles), explode('|', $permissions), array('validate_all' => $validateAll))){
            return response()->json(array(
                'error' => 'not_enough_permissions',
            ), 401);
        }

        return $next($request);
    }

}
