<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use \Symfony\Component\HttpFoundation\Response;

trait HandleApiResponseTrait
{
    public static function sendSuccessResponse($data = [], ?string $message = null, int $code = Response::HTTP_OK): JsonResponse
    {
        return response()->json([
            "success" => true,
            "code" => $code,
            "message" => $message ?? __("Success Response"),
            "data" => $data,
        ], $code);
    }

    public static function sendFailedResponse(?string $message = null, int $code = Response::HTTP_NOT_FOUND): JsonResponse
    {
        return response()->json([
            "success" => false,
            "code" => $code,
            "message" => $message ?? __("Failed Response"),
            "direct" => $code == Response::HTTP_UNAUTHORIZED ? "login" : null
        ], $code);
    }

}
