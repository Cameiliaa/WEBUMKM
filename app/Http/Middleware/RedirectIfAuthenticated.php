<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        if ($this->isAuthenticated($guards)) {
           return $this->redirectToHome();
    }

        return $next($request);
    }

    /**
    * Mengecek apakah user sudah login
    */
    private function isAuthenticated(array $guards): bool
    {
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return true;
            }
       }

       return false;
    }

    /**
    * Redirect ke halaman home
    */
    private function redirectToHome(): Response
    {
        return redirect(RouteServiceProvider::HOME);
    }
}
