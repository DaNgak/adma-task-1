<?php
    namespace App\Commons\Traits;

    use Illuminate\Http\JsonResponse;

    trait BaseApiResponse
        {
            public function apiResponse($message, $data = null, $statusCode = null): JsonResponse
            {
                return response()->json([
                    'code' => $statusCode,
                    'message' => $message,
                    'data' => $data,
                ], $statusCode);
            }

            public function apiSuccess($statusCode = 200, $message = null, $data = null): JsonResponse
            {
                return response()->json([
                    'code' => $statusCode,
                    'message' => $message,
                    'data' => $data,
                ], $statusCode);
            }

            public function apiError($errors, $message = null, $statusCode = 422): JsonResponse
            {
                return response()->json([
                    'code' => $statusCode,
                    'data' => $errors,
                    'message' => $message,
                ], $statusCode);
            }
    }
