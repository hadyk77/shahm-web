<?php

namespace App\Traits;

use App\Enums\ResponseEnum;
use Illuminate\Http\JsonResponse;
use \Symfony\Component\HttpFoundation\Response;

trait HandleApiResponseTrait
{
    public static function sendSuccessResponse($data = [], ?string $message = null, int $code = Response::HTTP_OK): JsonResponse
    {
        return response()->json([
            "success" => true,
            "code" => $code,
            "message" => $message ?? ResponseEnum::SUCCESS_RESPONSE,
            "data" => $data,
        ], $code);
    }

    public static function sendFailedResponse(?string $message = null, int $code = Response::HTTP_NOT_FOUND): JsonResponse
    {
        return response()->json([
            "success" => false,
            "code" => $code,
            "message" => $message ?? ResponseEnum::FAILED_RESPONSE,
            "data" => [],
        ], $code);
    }

}
