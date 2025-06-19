<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;

class VerificationController extends Controller
{
    // Trait ini menyediakan semua fungsionalitas untuk memverifikasi email pengguna
    use VerifiesEmails;

    /**
     * Where to redirect users after verifying their email address.
     *
     * @var string
     */
    protected $redirectTo = '/home'; // Mengarahkan pengguna ke halaman home setelah berhasil verifikasi email

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Middleware untuk memastikan pengguna sudah terautentikasi sebelum bisa melakukan verifikasi email
        $this->middleware('auth'); 

        // Middleware untuk memverifikasi email hanya jika tanda verifikasi dalam URL sudah ditandatangani (signed)
        $this->middleware('signed')->only('verify'); 

        // Middleware untuk membatasi jumlah permintaan verifikasi dan pengiriman ulang email
        $this->middleware('throttle:6,1')->only('verify', 'resend'); // 6 request per menit
    }
}
