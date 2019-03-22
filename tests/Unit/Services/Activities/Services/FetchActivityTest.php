<?php

namespace Tests\Unit\Services\Activities\Services;

use Tests\TestCase;
use Mockery\MockInterface;
use Deviate\Activities\Adapters\AdapterInterface;
use Deviate\Activities\Services\FetchActivity;
use Deviate\Activities\Repositories\FetchActivityRepository;
use Deviate\Activities\Exceptions\ActivityDoesntExistException;

class FetchActivityTest extends TestCase
{
    /** @test */
    public function it_can_fetch_an_activity()
    {
        /** @var AdapterInterface $adapter */
        $adapter = $this->mock(AdapterInterface::class, function (MockInterface $mock) {
            $mock->shouldReceive('fetch')->once()->with(1)->andReturn([
                'id'          => 1,
                'name'        => 'Test Activity',
                'description' => 'This is a test activity',
                'starts_at'   => '2019-01-01 09:00:00',
                'ends_at'     => '2019-01-01 15:30:00',
                'places'      => 10,
                'cost'        => 1000,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ]);
        });

        $service = new FetchActivity(new FetchActivityRepository($adapter));

        $activity = $service->run(1);

        $this->assertEquals('Test Activity', $activity['name']);
        $this->assertEquals('This is a test activity', $activity['description']);
        $this->assertEquals('2019-01-01 09:00:00', $activity['starts_at']);
        $this->assertEquals('2019-01-01 15:30:00', $activity['ends_at']);
        $this->assertEquals(10, $activity['places']);
        $this->assertEquals(1000, $activity['cost']);
    }

    /** @test */
    public function it_throws_an_exception_if_the_activity_cant_be_found()
    {
        /** @var AdapterInterface $adapter */
        $adapter = $this->mock(AdapterInterface::class, function (MockInterface $mock) {
            $mock->shouldReceive('fetch')->once()->with(1)->andReturn(null);
        });

        $service = new FetchActivity(new FetchActivityRepository($adapter));

        $this->expectException(ActivityDoesntExistException::class);

        $service->run(1);
    }
}
