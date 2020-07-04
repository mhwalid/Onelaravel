<?php

namespace App\Http\Middleware;

use Closure;

class chackAge
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($req, Closure $next)
    {

        if ($req->age > 15) {
            return redirect()->route('login');
        }

        return $next($req);
    }
}
