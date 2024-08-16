<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserAkses
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$role): Response
    {
        if (in_array(auth()->user()->role, $role)) {
            return $next($request);
        }
        switch (auth()->user()->role) {
            case 'admin':
                return redirect('/dashboard/admin');
            case 'guru':
                return redirect('/dashboard/guru');
            case 'petugas':
                return redirect('/dashboard/petugas');
            case 'siswa':
                return redirect('/dashboard/siswa');
            default:
                return redirect('/');
        }
    }
}

?>