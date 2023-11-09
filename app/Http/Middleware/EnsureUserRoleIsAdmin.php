<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserRoleIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check() || Auth::user()->role !== 2) {
            // If user is not logged in or user role is not 1 (admin), redirect them with an error message.
            toastr()->addError('bạn không đủ quyền vào trang này.');
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}
