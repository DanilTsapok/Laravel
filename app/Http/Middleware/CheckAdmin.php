<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        $user=Auth::user();
        $rolesArray = explode('|',$role);
        if(in_array($user->role, $rolesArray)){
            return $next($request);
        }

        return redirect()->route('home')->with('error', 'Access denied. Admins only.');
    }
}
