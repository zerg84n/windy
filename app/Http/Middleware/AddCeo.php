<?php

namespace App\Http\Middleware;

use Closure;

class AddCeo
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
       
        $path = '/'.$request->path();
        $item = \App\Item::where('url',$path)->first();
        
        return $next($request);
    }
}
