<?php

namespace Omalizadeh\ApiResponse\Tests;

use Omalizadeh\ApiResponse\Resources\BaseApiResource;

class BaseApiResourceCollectionTest extends TestCase
{
    public function testMainKeysExist(): void
    {
        $resource = BaseApiResource::collection(['data' => []])->toArray();

        $this->assertArrayHasKey('data', $resource);
        $this->assertArrayHasKey('message', $resource);
        $this->assertArrayHasKey('errors', $resource);
    }

    public function testCollectionKeysExist(): void
    {
        $resource = BaseApiResource::collection(['data' => []])->toArray();
        $resourceData = $resource['data'];

        $this->assertArrayHasKey('items', $resourceData);
        $this->assertArrayHasKey('count', $resourceData);
        $this->assertArrayHasKey('sums', $resourceData);
    }

    public function testDataItems(): void
    {
        $data = [
            [
                'key' => 'value'
            ],
            [
                'key' => 'value'
            ]

        ];

        $resource = BaseApiResource::collection(['data' => $data])->toArray();
        $resourceData = $resource['data'];

        $this->assertIsArray($resourceData['items']);
        $this->assertIsInt($resourceData['count']);
        $this->assertCount(2, $resourceData['items']);
        $this->assertEquals(2, $resourceData['count']);
    }

    public function testItemsCount(): void
    {
        $data = [
            [
                'key' => 'value'
            ]
        ];

        $resource = BaseApiResource::collection(['data' => $data, 'count' => 150])->toArray();
        $resourceData = $resource['data'];

        $this->assertEquals(150, $resourceData['count']);
    }
}
