<?php

namespace Omalizadeh\ApiResponse\Tests;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class CommandTest extends TestCase
{
    protected string $resourceFileName = 'TestResource.php';
    protected string $requestFileName = 'TestRequest.php';

    protected function setUp(): void
    {
        parent::setUp();

        $this->removeRequestAndResourceFile();
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        $this->removeRequestAndResourceFile();
    }

    public function testMakeApiResourceCommandCreatesApiResourceClass(): void
    {
        Artisan::call('make:api-resource TestResource');

        $this->assertTrue(File::exists($this->getResourcePath($this->resourceFileName)));
    }

    public function testMakeApiRequestCommandCreatesApiRequestClass(): void
    {
        Artisan::call('make:api-request TestRequest');

        $this->assertTrue(File::exists($this->getRequestPath($this->requestFileName)));
    }

    protected function removeRequestAndResourceFile(): void
    {
        if (File::exists($this->getResourcePath($this->resourceFileName))) {
            unlink($this->getResourcePath($this->resourceFileName));
        }

        if (File::exists($this->getResourcePath($this->requestFileName))) {
            unlink($this->getResourcePath($this->requestFileName));
        }
    }
}
