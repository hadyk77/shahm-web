<?php

namespace App\Exceptions;

use App\Enums\ResponseEnum;
use App\Traits\HandleApiResponseTrait;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{

    use HandleApiResponseTrait;

    protected $levels = [
        //
    ];

    protected $dontReport = [
        //
    ];

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register()
    {
        $this->reportable(function (Throwable $e) {

        });

        $this->renderable(function (NotFoundHttpException $e, $request) {
            if ($request->is('api/*')) {
                return $this::sendFailedResponse(ResponseEnum::MODEL_DATA_NOT_FOUND);
            }
        });

        $this->renderable(function (ThrottleRequestsException $e, $request) {
            if ($request->is('api/*')) {
                return $this::sendFailedResponse(ResponseEnum::TOO_MANY_ATTEMPTS);
            }
        });
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return $this->shouldReturnJson($request, $exception)
            ? response()->json([
                "success" => false,
                "code" => Response::HTTP_UNAUTHORIZED,
                'message' => ResponseEnum::UNAUTHENTICATED,
                "data" => []
            ], 401)
            : redirect()->guest($exception->redirectTo() ?? route('login'));
    }

    protected function invalidJson($request, ValidationException $exception)
    {
        return response()->json([
            "success" => false,
            "code" => $exception->status,
            'message' => $exception->getMessage(),
            'errors' => $exception->errors(),
        ], $exception->status);
    }
}
