<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Auth;

class SessionTimeout
{
    protected $session;
    protected $timeout = 3600; // 1 hour in seconds for regular users

    public function __construct(Store $session)
    {
        $this->session = $session;
    }

    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return $next($request);
        }

        $user = Auth::user();
        $isAdmin = $user->level === 'admin';

        if (!$this->session->has('last_activity')) {
            $this->session->put('last_activity', time());
        }

        if ($isAdmin) {
            // For admin, check if they're still on admin routes
            if (!$request->is('admin*')) {
                Auth::logout();
                return redirect()->route('login')->with('message', 'Admin session ended due to leaving admin area.');
            }
        } else {
            // For regular users, check timeout
            if (time() - $this->session->get('last_activity') > $this->timeout) {
                $this->session->forget('last_activity');
                Auth::logout();
                return redirect()->route('login')->with('message', 'Session expired. Please login again.');
            }
        }

        $this->session->put('last_activity', time());

        return $next($request);
    }
}