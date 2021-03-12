<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class AccessToken
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
        $token = $request->header('api_token');
        if($users = User::where('api_token', $token)->exists()){
            return $next($request);
        }else{
            $code = 200;
            $response = [
                'result'  => false,
                'message' => 'No tienes permisos',
                'data' => [],
            ];
            return response()->json($response, $code);
        }
    }
}
