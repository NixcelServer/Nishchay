<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DevAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
         // Retrieve the authenticated user
         $user = session('user');

         if($user)
         {
            $modules = session('uniqueParentNames');

            if(in_array('Tasks',$modules)){
                return $next($request);
            }
            else{
                return redirect('/dashboard');
            }
         }

 
        return redirect('/');
    }
}
