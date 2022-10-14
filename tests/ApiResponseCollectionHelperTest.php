<?php

namespace Omalizadeh\ApiResponse\Tests;

use Illuminate\Contracts\Support\Responsable;

class ApiResponseCollectionHelperTest extends TestCase
{
    public function testMainKeysExist(): void
    {
        $resource = apiResponse()->collection([])->get()->getData(true);

        $this->assertArrayHasKey('data', $resource);
        $this->assertArrayHasKey('message', $resource);
        $this->assertArrayHasKey('errors', $resource);
    }

    public function testApiResponseClassIsResponsable(): void
    {
        $resource = apiResponse()->collection([]);

        $this->assertInstanceOf(Responsable::class, $resource);
        $this->assertEquals(200, $resource->toResponse()->getStatusCode());
    }

    public function testApiResponseClassWithStatusIsResponsable(): void
    {
        $resource = apiResponse()->collection([])->status(201);

        $this->assertInstanceOf(Responsable::class, $resource);
        $this->assertNotEquals(200, $resource->toResponse()->getStatusCode());
    }

    public function testCollectionKeysExist(): void
    {
        $resource = apiResponse()->collection([])->get()->getData(true);
        $resourceData = $resource['data'];

        $this->assertArrayHasKey('items', $resourceData);
        $this->assertArrayHasKey('count', $resourceData);
        $this->assertArrayHasKey('sums', $resourceData);
    }

    public function testItems(): void
    {
        $data = [
            [
                'key' => 'value'
            ],
            [
                'key' => 'value'
            ]
        ];

        $resource = apiResponse()->collection($data)->get()->getData(true);
        $resourceData = $resource['data'];

        $this->assertEquals($data, $resourceData['items']);
        $this->assertEquals(2, $resourceData['count']);
    }

    public function testItemsCount(): void
    {
        $data = [
            [
                'key' => 'value'
            ]
        ];

        $resource = apiResponse()->collection($data, 150)->get()->getData(true);
        $resourceData = $resource['data'];

        $this->assertEquals(150, $resourceData['count']);
    }

    public function testMessage(): void
    {
        $resource = apiResponse()->collection([])->message('profile updated.')->get()->getData(true);

        $this->assertIsString($resource['message']);
        $this->assertEquals('profile updated.', $resource['message']);
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
