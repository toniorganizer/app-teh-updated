<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CekUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$levels)
    {

        if (!Auth::check()) {
            return redirect('login');
        }

        $currentUserLevel = Auth::user()->level;

        // Periksa apakah ID pengguna saat ini ada dalam daftar yang diizinkan
        if (in_array($currentUserLevel, $levels)) {
            return $next($request);
        } else {
            return redirect('error-akses');
        }

    }
}
