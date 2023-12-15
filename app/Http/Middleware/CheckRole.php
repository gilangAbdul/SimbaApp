<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Periksa apakah pengguna memiliki role yang diizinkan
        $user = auth()->user();
        if ($user == null) {
            return redirect('/');
        }

        if (in_array($user->role_id, $roles)) {
            return $next($request);
        }

        // Jika tidak memiliki hak akses, bisa diarahkan ke halaman lain atau memberikan respons yang sesuai
        return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk mengakses halaman ini.');
    }
}
