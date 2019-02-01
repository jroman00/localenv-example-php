<?php

namespace App\Helpers;

use Mockery;
use PHPUnit\Framework\TestCase;
use Predis\Client;

class RedisHelperTest extends TestCase
{
    /**
     * Test the getInstance() method
     *
     * @return void
     */
    public function testGetInstance(): void
    {
        // Start with a null instance
        RedisHelper::setInstance(null);

        // Test that the received instance is of type RedisHelper
        $instance1 = RedisHelper::getInstance();
        $this->assertInstanceOf(RedisHelper::class, $instance1);

        // Test that the second request to getInstance returns a cached instance
        $instance2 = RedisHelper::getInstance();
        $this->assertSame($instance1, $instance2);

        RedisHelper::setInstance(null);

        // Test that a new instance gets created
        $instance3 = RedisHelper::getInstance();
        $this->assertNotSame($instance1, $instance3);
    }

    /**
     * @return array
     */
    public function isReadyDataProvider(): array
    {
        return [
            'redis is ready' => [true, 'PONG'],
            'redis is not ready' => [false, null],
        ];
    }

    /**
     * Test the isReady() method
     *
     * @dataProvider isReadyDataProvider
     *
     * @param bool $expected
     * @param $pingResponse
     */
    public function testIsReady(bool $expected, $pingResponse): void
    {
        $client = Mockery::mock(Client::class);
        $client->shouldReceive('ping->getPayload')
            ->once()
            ->andReturn($pingResponse);

        $redisHelper = new RedisHelper($client);

        $this->assertSame($expected, $redisHelper->isReady());
    }
}
