<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function attemptLogin(Request $request)
    {
        return Auth::attempt(
            [
                $this->username() => $request->input($this->username()),
                'password' => $request->input('password')
            ], 
            $request->filled('remember')
        );
    }

    public function username()
    {
        return 'username';
    }

    protected function authenticated(Request $request, $user)
{
    if ($user->level === 'admin') {
        Auth::guard('admin')->login($user);
        return redirect()->intended(route('admin.dashboard'));
    }

    $cartItems = Cart::where('user_id', $user->id)->with('book')->get();
    session(['cart' => $cartItems]);
    return redirect()->intended(route('home'));
}
}