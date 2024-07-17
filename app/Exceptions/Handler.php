<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Exception Page
     */
    public function render($request, Throwable $e)
    {
        $errorMessage = $e->getMessage();
        $errorCode = $e->getCode();

        return response()->view('errors.error-404', [
            'errorMessage' => $errorMessage,
            'errorCode' => $errorCode
        ], 500);
    }
}
