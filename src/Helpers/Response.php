<?php

namespace Omalizadeh\ApiResponse\Helpers;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response as HttpResponse;
use Omalizadeh\ApiResponse\Resources\BaseApiResource;

abstract class Response implements Responsable
{
    protected string $jsonResource = BaseApiResource::class;

    private ?string $message;
    private int $status;

    public function __construct(
        ?string $message = null,
        int $status = HttpResponse::HTTP_OK,
    ) {
        $this->message = $message;
        $this->status = $status;
    }

    public function message(?string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function status(int $code): self
    {
        $this->status = $code;

        return $this;
    }

    public function jsonResource(string $jsonResource): self
    {
        $this->jsonResource = $jsonResource;

        return $this;
    }

    public function get(): JsonResponse
    {
        return response()->json($this->respond(), $this->getStatus());
    }

    protected function getMessage(): ?string
    {
        return $this->message;
    }

    protected function getStatus(): int
    {
        return $this->status;
    }

    protected function getJsonResource(): string
    {
        return $this->jsonResource;
    }

    abstract protected function respond(): JsonResource;

    public function toResponse($request = null): JsonResponse
    {
        return $this->get();
    }
}
