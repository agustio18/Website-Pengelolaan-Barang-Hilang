<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(
        Request $request,
        Closure $next
    ): Response {
        if (!session()->has('admin_id')) {
            return redirect()->route('admin.login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        $user = \App\Models\User::find(session('admin_id'));

        if (!$user || $user->role !== 'admin') {
            session()->forget(['admin_id', 'admin_name']);

            return redirect()->route('admin.login')
                ->with('error', 'Akses hanya untuk administrator.');
        }

        return $next($request);
    }
}
