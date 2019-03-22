<?php

namespace Tests\Unit\Services\Activities\Services;

use Tests\TestCase;
use Mockery\MockInterface;
use Deviate\Activities\Services\DeleteActivity;
use Deviate\Activities\Adapters\AdapterInterface;
use Deviate\Activities\Repositories\DeleteActivityRepository;

class DeleteActivityTest extends TestCase
{
    /** @test */
    public function test_an_activity_can_be_deleted()
    {
        /** @var AdapterInterface $adapter */
        $adapter = $this->mock(AdapterInterface::class, function (MockInterface $mock) {
            $mock->shouldReceive('delete')->once()->with(['id' => 1])->andReturn(true);
        });

        $repository = new DeleteActivityRepository($adapter);

        $service = new DeleteActivity($repository);

        $result = $service->run(1);

        $this->assertNull($result);
    }
}
