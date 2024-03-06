<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EncodeIdMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        dd($request->all());
        // Encode the 'id' parameter in the URL
        $id = $request->route('id');
    $encodedId = rawurlencode($id);
        
        // Update the 'id' parameter in the route
        $request->route()->setParameter('id', $encodedId);
        dd($encodedId);
        return $next($request);
    }
}
