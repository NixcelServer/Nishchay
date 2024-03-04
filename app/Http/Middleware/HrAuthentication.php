<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HrAuthentication
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
        
        // Check if the user is authenticated and has role ID 1
        if ($user) {
            // Retrieve the modules associated with the user
            $modules = session('uniqueParentNames');
            
            // Check if the 'Employees' module exists in the user's modules
            if (in_array('Employees', $modules)) {
                // User has the 'Employees' module, proceed with the request
                return $next($request);
            }
        } else {
            // User does not have role ID 1, unauthorized access
            abort(403, 'Unauthorized');
        }

        return redirect('/');
    }
}
