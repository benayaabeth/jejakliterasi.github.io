<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    // Trait ini menyediakan semua fungsionalitas untuk mereset password pengguna
    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home'; // Mengarahkan pengguna ke halaman home setelah berhasil mereset password
}
