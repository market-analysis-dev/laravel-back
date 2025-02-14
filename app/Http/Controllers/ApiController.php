<?php

namespace App\Http\Controllers;

use App\Responses\ApiResponse;

abstract class ApiController
{
    /**
     * Creates a JSON response with the given message, optional data, extra data, success status, and HTTP status code.
     *
     * @param string $message The message to include in the response.
     * @param mixed|null $data The optional data to include in the response.
     * @param array|null $extraData Any extra data to merge with the response.
     * @param bool $success The success status of the response (defaults to true).
     * @param int $status The HTTP status code for the response (defaults to 200).
     *
     * @return \App\Responses\ApiResponse The JSON response containing the specified data, success status, and HTTP status code.
     */
    protected function response(string $message, mixed $data = null, ?array $extraData = null, bool $success = true, ?array $errors = null, int $status = 200): ApiResponse
    {
        return new ApiResponse($message, $data, $extraData, $success, $errors, $status);
    }

    protected function success(?string $message = null, mixed $data = null, ?array $extraData = null): ApiResponse
    {
        return ApiResponse::success($message, $data, $extraData);
    }

    public function created(string $message, mixed $data = null, ?array $extraData = null): ApiResponse
    {
        return ApiResponse::created($message, $data, $extraData);
    }

    protected function error(string $message, mixed $data = null, int $status = 400): ApiResponse
    {
        return ApiResponse::error($message, $data, $status);
    }

    protected function errorUnprocessableEntity(string $message, mixed $data = null, ?array $extraData = null): ApiResponse
    {
        return ApiResponse::errorUnprocessableEntity($message, $data);
    }
}
