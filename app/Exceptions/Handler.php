<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    public function report(Throwable $exception)
    {
        if (app()->bound('sentry') && $this->shouldReport($exception)) {
            app('sentry')->captureException($exception);
        }

        parent::report($exception);
    }

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {

    }

    public function render($request, Throwable $exception)
    {
        if (env("APP_DEBUG")) {
            return parent::render($request, $exception);
        } else {

            //404
            if ($exception instanceof NotFoundHttpException ||
                $exception instanceof ModelNotFoundException) {
                return response()->json([
                    'message' => 'not found'
                ], 404);
            }


            //422

            if ($exception instanceof ValidationException) {

                $message = $exception->errors();

                return response()->json([
                    'message' => $message
                ], 422);
            }


            return response()->json([
                'message' => 'server error'
            ], 500);
        }
    }


}
