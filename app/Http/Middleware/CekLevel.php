<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CekLevel
{
    public function handle(Request $request, Closure $next, ...$levels): Response
    {
        // pastikan user login
        if (!Auth::check()) {
            return redirect('/login');
        }

        // ambil level user
        $userLevel = Auth::user()->level;

        // cek apakah level diizinkan
        if (in_array($userLevel, $levels)) {
            return $next($request);
        }

        return abort(403, 'Unauthorized');
    }
}