<?php

namespace App\Responses;

use Illuminate\Contracts\Support\Responsable;

class ApiResponse implements Responsable
{

    public function __construct(
        protected ?string $message = null,
        protected mixed   $data = null,
        protected ?array  $extraData = null,
        protected bool    $success = true,
        protected ?array  $errors = null,
        protected int     $status = 200
    )
    {
    }

    public function toResponse($request): \Illuminate\Http\JsonResponse
    {
        $payload = [
            'success' => $this->success,
        ];
        if ($this->message) {
            $payload['message'] = $this->message;
        }
        if ($this->data) {
            $payload['data'] = $this->data;
        }

        if ($this->errors) {
            $payload['errors'] = $this->errors;
        }

        if ($this->extraData) $payload = array_merge($payload, $this->extraData);


        return response()->json(
            data: $payload,
            status: $this->status,
            options: JSON_UNESCAPED_UNICODE
        );
    }

    public static function success(?string $message = null, mixed $data, ?array $extraData = null): static
    {
        return new static($message, $data, extraData: $extraData, status: 200);
    }

    public static function created(string $message, mixed $data, ?array $extraData = null): static
    {
        return new static($message, $data, $extraData, status: 201);
    }

    public static function notFound(string $message): static
    {
        return new static($message, success: false, status: 404);
    }

    public static function error(string $message, ?array $errors = null, $status = 400): static
    {
        return new static($message, success: false, errors: $errors, status: $status);
    }

    public static function errorUnauthorized(\Illuminate\Auth\AuthenticationException $e): static
    {
        return new static($e->getMessage(), success: false, status: 401);
    }

    public static function errorUnprocessableEntity(string $message, ?array $errors = null): static
    {
        return new static($message, success: false, errors: $errors, status: 422);
    }

    public static function errorFailedValidation(\Illuminate\Validation\ValidationException $e): static
    {
        $errors = $e->validator->errors()->toArray();
        return self::errorUnprocessableEntity($e->getMessage(), $errors);
    }
}
