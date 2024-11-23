<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;


class WebgestMiddleware
{
    /** 
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       
        if(Session::has('sale_type')){
            // Allow the request to proceed if the user is authenticated and is an Admin
            return $next($request);
        }
        
         Session::put('sale_type','Retail');
         return redirect()->back();
    }
}
