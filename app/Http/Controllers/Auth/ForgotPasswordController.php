<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Menambahkan middleware guest untuk memastikan hanya pengguna yang belum login yang bisa mengakses halaman ini
        $this->middleware('guest');
    }
}
