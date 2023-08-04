<?php

namespace Omalizadeh\ApiResponse\Tests;

use Omalizadeh\ApiResponse\Resources\BaseApiResource;
use stdClass;

class BaseApiResourceTest extends TestCase
{
    public function testMainKeysExist(): void
    {
        $resource = (new BaseApiResource(['data' => null]))->toArray();

        $this->assertArrayHasKey('data', $resource);
        $this->assertArrayHasKey('message', $resource);
        $this->assertArrayHasKey('errors', $resource);
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

        $resource = (new BaseApiResource(['data' => $data]))->toArray();

        $this->assertEquals($data, $resource['data']);
    }

    public function testObjectData(): void
    {
        $data = (object) [
            'key' => 'value'
        ];

        $resource = (new BaseApiResource(['data' => $data]))->toArray();

        $this->assertIsObject($resource['data']);
        $this->assertTrue(isset($resource['data']->key));
        $this->assertEquals('value', $resource['data']->key);
    }

    public function testEmptyObjectToNullConversionInDataKey(): void
    {
        $data = new stdClass();
        $resource = (new BaseApiResource(['data' => $data]))->toArray();

        $this->assertNull($resource['data']);
    }

    public function testMessage(): void
    {
        $resource = (new BaseApiResource(['message' => 'form submitted.']))->toArray();

        $this->assertIsString($resource['message']);
        $this->assertEquals('form submitted.', $resource['message']);
    }

    public function testErrors(): void
    {
        $errors = [
            'password' => [
                'wrong password.'
            ]
        ];

        $resource = (new BaseApiResource([
            'errors' => $errors,
        ]))->toArray();

        $this->assertEquals($errors, $resource['errors']);
    }

    public function testMoreKeysCanBeAddedToResource(): void
    {
        $resource = (new BaseApiResource([
            'next' => 'path',
            'back' => 'previous'
        ]))->toArray();

        $this->assertArrayHasKey('next', $resource);
        $this->assertArrayHasKey('back', $resource);
        $this->assertEquals('path', $resource['next']);
        $this->assertEquals('previous', $resource['back']);
    }

    public function testMakingResourceByStaticCall(): void
    {
        $resource = BaseApiResource::make([
            'data' => [
                'id' => 1,
            ],
            'message' => 'message'
        ])->toArray();

        $this->assertArrayHasKey('data', $resource);
        $this->assertArrayHasKey('message', $resource);
        $this->assertArrayHasKey('errors', $resource);
        $this->assertEquals(1, $resource['data']['id']);
    }
}
