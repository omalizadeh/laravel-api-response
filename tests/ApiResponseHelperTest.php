<?php

namespace Omalizadeh\ApiResponse\Tests;

use Illuminate\Contracts\Support\Responsable;
use stdClass;

class ApiResponseHelperTest extends TestCase
{
    public function testMainKeysExist(): void
    {
        $resource = apiResponse()->data([])->get()->getData(true);

        $this->assertArrayHasKey('data', $resource);
        $this->assertArrayHasKey('message', $resource);
        $this->assertArrayHasKey('errors', $resource);
    }

    public function testApiResponseClassIsResponsable(): void
    {
        $resource = apiResponse()->data([]);

        $this->assertInstanceOf(Responsable::class, $resource);
        $this->assertEquals(200, $resource->toResponse()->getStatusCode());
    }

    public function testApiResponseClassWithStatusIsResponsable(): void
    {
        $resource = apiResponse()->data([])->status(201);

        $this->assertInstanceOf(Responsable::class, $resource);
        $this->assertNotEquals(200, $resource->toResponse()->getStatusCode());
    }

    public function testArrayData(): void
    {
        $data = [
            [
                'key' => 'value'
            ],
            [
                'key' => 'value'
            ]
        ];

        $resource = apiResponse()->data($data)->get()->getData(true);

        $this->assertEquals($data, $resource['data']);
    }

    public function testEmptyObjectDataToNullConversion(): void
    {
        $data = new stdClass();
        $resource = apiResponse()->data($data)->get()->getData(true);

        $this->assertNull($resource['data']);
    }

    public function testMessage(): void
    {
        $resource = apiResponse()->message('form submitted.')->get()->getData(true);

        $this->assertIsString($resource['message']);
        $this->assertEquals('form submitted.', $resource['message']);
    }

    public function testErrors(): void
    {
        $errors = [
            'password' => [
                'wrong password.',
            ],
        ];

        $resource = apiResponse()->errors($errors)->get()->getData(true);

        $this->assertEquals($errors, $resource['errors']);
    }
}
