<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateMiddleware
{
    public function handle(Request $request, Closure $next) {
        // show a little toaster to say "please login to view this page"
        if (!auth()->check()) {
            $request->session()->flash('error', 'You must log in to access this page.');

            return redirect('/login');
        }

        return ($next($request));
    }
}
