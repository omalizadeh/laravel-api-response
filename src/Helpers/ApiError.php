<?php

namespace Omalizadeh\ApiResponse\Helpers;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response as HttpResponse;

class ApiError extends Response
{
    private array $errors;

    public function errors(
        array $errors,
        int $status = HttpResponse::HTTP_UNPROCESSABLE_ENTITY,
    ): self {
        $this->errors = $errors;

        $this->status($status);

        return $this;
    }

    protected function respond(): JsonResource
    {
        $resource = [
            'errors' => $this->errors,
            'message' => $this->getMessage(),
        ];

        $jsonResource = $this->getJsonResource();

        return new $jsonResource($resource);
    }
}
