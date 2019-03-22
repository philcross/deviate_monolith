<?php

namespace Tests\Unit\Services\Activities\Services;

use Tests\TestCase;
use Mockery\MockInterface;
use Deviate\Activities\Adapters\AdapterInterface;
use Deviate\Activities\Services\StoreNewActivity;
use Deviate\Activities\Repositories\StoreActivityRepository;

class CreateActivityTest extends TestCase
{
    /** @test */
    public function it_can_store_a_new_activity()
    {
        $data = [
            'name'        => 'Test Activity 1',
            'description' => 'This is a test activity 1',
            'starts_at'   => '2019-01-02 09:00:00',
            'ends_at'     => '2019-01-02 15:30:00',
            'places'      => 20,
            'cost'        => 2000,
        ];

        /** @var AdapterInterface $adapter */
        $adapter = $this->mock(AdapterInterface::class, function (MockInterface $mock) use ($data) {
            $mock->shouldReceive('store')->once()->with($data)->andReturn(1);
        });

        $service = new StoreNewActivity(new StoreActivityRepository($adapter));

        $id = $service->run($data);

        $this->assertEquals(1, $id);
    }
}
