<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserRoles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (Auth::check()) 
        {
            if (Auth::user()->role == $role) 
            {
                return $next($request);
            } 
            else if (Auth::user()->role == User::user_role_admin) 
            {
                return $next($request);
            }
            else 
            {
                return response()->view('errors.403', [], 403);
            }
        }

        return redirect('/login');
    }
}
