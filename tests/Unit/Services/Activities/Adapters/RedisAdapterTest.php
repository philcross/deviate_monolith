<?php

namespace Tests\Unit\Services\Activities\Adapters;

use Illuminate\Support\Facades\Redis;
use Deviate\Activities\Adapters\RedisAdapter;
use Deviate\Activities\Adapters\AdapterInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RedisAdapterTest extends AbstractAdapterTest
{
    use RefreshDatabase;

    protected function getAdapter(): AdapterInterface
    {
        return new RedisAdapter(Redis::connection('test'));
    }

    protected function setUp(): void
    {
        parent::setUp();

        Redis::connection('test')->rpush('activities', json_encode([
            'id'          => 1,
            'name'        => 'Test Activity',
            'description' => 'This is a test activity',
            'starts_at'   => '2019-01-01 09:00:00',
            'ends_at'     => '2019-01-01 15:30:00',
            'places'      => 10,
            'cost'        => 1000,
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]));
    }

    protected function tearDown(): void
    {
        Redis::connection('test')->del('activities');

        parent::tearDown();
    }
}
