<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$guards)
    {
        // Default guards jika tidak ada yang diberikan
        $guards = empty($guards) ? [null] : $guards;

        // Mengecek setiap guard yang diterima
        foreach ($guards as $guard) {
            // Mengecek apakah pengguna sudah login dengan guard tertentu
            if (Auth::guard($guard)->check()) {
                $user = Auth::guard($guard)->user();

                // Redireksi berdasarkan level pengguna
                if ($user->level === 'admin') {
                    return redirect()->route('admin.dashboard'); // Redireksi ke dashboard admin
                }

                return redirect(RouteServiceProvider::HOME); // Redireksi ke halaman utama user
            }
        }

        // Melanjutkan request jika pengguna tidak terautentikasi
        return $next($request);
    }
}
