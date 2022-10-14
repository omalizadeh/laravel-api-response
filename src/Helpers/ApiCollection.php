<?php

namespace Omalizadeh\ApiResponse\Helpers;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

class ApiCollection extends Response
{
    private array|Collection $items;
    private ?int $count;
    private ?array $sums;

    public function collection(array|object $items, ?int $count = null, ?array $sums = null): self
    {
        $this->items = $items;
        $this->count = $count;
        $this->sums = $sums;

        return $this;
    }

    protected function respond(): JsonResource
    {
        $resource = [
            'data' => $this->items,
            'count' => $this->count,
            'sums' => $this->sums,
            'message' => $this->getMessage(),
        ];

        $jsonResource = $this->getJsonResource();

        return $jsonResource::collection($resource);
    }
}
