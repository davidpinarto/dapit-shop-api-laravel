<?php

namespace App\Exceptions;

use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception): JsonResponse
    {
        if ($exception instanceof ClientError) {
            $errorMessage = $exception->getMessage();
            $errorStatusCode = $exception->getStatusCode();

            Log::error('Client Error: ' . $errorMessage);

            $response = [
                'status' => 'fail',
                'message' => $errorMessage,
            ];
            return response()->json($response, $errorStatusCode);
        }

        if ($exception instanceof ValidationException) {
            $errorMessage = $exception->getMessage();

            Log::error('Validation Error: ' . $errorMessage);

            $response = [
                'status' => 'fail',
                'message' => $errorMessage,
            ];
            return response()->json($response, 400);
        }

        Log::error('There is something error: ' . $exception->getMessage());

        $response = [
            'status' => 'fail',
            'message' => 'There is something error on our server',
        ];
        return response()->json($response, 500);
    }
}
