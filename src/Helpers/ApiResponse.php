<?php

namespace Omalizadeh\ApiResponse\Helpers;

use Illuminate\Http\Response;
use Illuminate\Support\Collection;

class ApiResponse
{
    public function collection(array|Collection $items, ?int $count = null, ?array $sums = null): ApiCollection
    {
        return (new ApiCollection())->collection($items, $count, $sums);
    }

    public function data(array|null|object $data): ApiData
    {
        return (new ApiData())->data($data);
    }

    public function message(string $message): ApiData
    {
        return (new ApiData())->message($message);
    }

    public function errorMessage(string $message, int $status = Response::HTTP_UNPROCESSABLE_ENTITY): ApiData
    {
        return (new ApiData())->message($message)->status($status);
    }

    public function errors(array $errors, int $status = Response::HTTP_UNPROCESSABLE_ENTITY): ApiError
    {
        return (new ApiError())->errors($errors, $status);
    }
}
