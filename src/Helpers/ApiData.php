<?php

namespace Omalizadeh\ApiResponse\Helpers;

use Illuminate\Http\Resources\Json\JsonResource;

class ApiData extends Response
{
    private array|null|object $data = null;

    public function data($data): self
    {
        $this->data = $data;

        return $this;
    }

    protected function respond(): JsonResource
    {
        $resource = [
            'data' => $this->data,
            'message' => $this->getMessage(),
        ];

        $jsonResource = $this->getJsonResource();

        return new $jsonResource($resource);
    }
}
