<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Auth\AuthenticationException;

class Handler extends ExceptionHandler
{
    protected $dontReport = [
        // Daftar pengecualian yang tidak perlu dilaporkan
    ];

    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            // Menangani pelaporan pengecualian
        });

        $this->renderable(function (ModelNotFoundException $e) {
            return response()->view('errors.404', [], 404);
        });

        $this->renderable(function (NotFoundHttpException $e) {
            return response()->view('errors.404', [], 404);
        });

        // Menangani pengecualian lainnya (opsional)
        // $this->renderable(function (ValidationException $e) {
        //     return response()->json($e->errors(), 422);
        // });

        // $this->renderable(function (QueryException $e) {
        //     return response()->view('errors.database', [], 500);
        // });

        // $this->renderable(function (MethodNotAllowedHttpException $e) {
        //     return response()->view('errors.405', [], 405);
        // });
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return $request->expectsJson()
            ? response()->json(['message' => 'Unauthenticated.'], 401)
            : redirect()->guest(route('login'))->with('error', 'Please login to continue.');
    }
}
