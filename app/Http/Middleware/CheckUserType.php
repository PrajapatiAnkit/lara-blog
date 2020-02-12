<?php

namespace App\Http\Middleware;

use Closure;

class CheckUserType
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

        if ($request->userType !=1){
            return response()->json([
                'error' => 'This user is not authenticated !',
            ]);
        }
        return $next($request);
    }
}
