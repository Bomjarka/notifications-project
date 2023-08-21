<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class BaseControllers extends Controller
{
    /**
     * @param $response
     * @param $code
     * @return JsonResponse
     */
    private function sendResponse($response, $code): JsonResponse
    {
        return response()->json($response, $code);
    }

    /**
     * @param $result
     * @param $message
     * @return JsonResponse
     */
    public function sendSuccess($result, $message): JsonResponse
    {
        $response = [
            'success' => true,
            'data' => $result,
            'message' => $message
        ];
        return $this->sendResponse($response, Response::HTTP_OK);
    }

    /**
     * @param string $error
     * @param array $errorMessages
     * @param int $code
     * @return JsonResponse
     */
    public function sendError(string $error, array $errorMessages = [], int $code = Response::HTTP_NOT_FOUND): JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];
        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

       return $this->sendResponse($response, $code);
    }
}
