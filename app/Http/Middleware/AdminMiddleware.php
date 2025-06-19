<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
{
    if (!auth('admin')->check() || auth('admin')->user()->level !== 'admin') {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthorized. Admin access required.'], 403);
        }
        return redirect()->route('home')->with('error', 'Unauthorized. Admin access required.');
    }

    return $next($request);
}
}