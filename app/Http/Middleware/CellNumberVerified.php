<?php

namespace App\Http\Middleware;

use Closure;

class CellNumberVerified
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
        if($request->user()->profile->cell_number_verified_at == null){

            return redirect()->route('auth.cell.verified');
        }
        return $next($request);
    }
}
