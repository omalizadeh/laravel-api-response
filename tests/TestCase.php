<?php

namespace Omalizadeh\ApiResponse\Tests;

use Omalizadeh\ApiResponse\ApiResponseServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            ApiResponseServiceProvider::class
        ];
    }

    protected function getResourcePath(?string $resourceFileName = null): string
    {
        return app_path("Http/Resources"."/$resourceFileName");
    }

    protected function getRequestPath(?string $requestFileName = null): string
    {
        return app_path("Http/Requests"."/$requestFileName");
    }
}
