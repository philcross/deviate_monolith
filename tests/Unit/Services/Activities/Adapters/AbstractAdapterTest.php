<?php

namespace Tests\Unit\Services\Activities\Adapters;

use Deviate\Activities\Adapters\AdapterInterface;
use Tests\TestCase;

abstract class AbstractAdapterTest extends TestCase
{
    /** @test */
    public function it_can_check_to_see_if_an_activity_exists()
    {
        $adapter = $this->getAdapter();

        $this->assertTrue($adapter->exists(1));
        $this->assertFalse($adapter->exists(2));
    }

    /** @test */
    public function it_can_fetch_an_activity()
    {
        $adapter = $this->getAdapter();

        $activity = $adapter->fetch(1);

        $this->assertEquals('Test Activity', $activity['name']);
        $this->assertEquals('This is a test activity', $activity['description']);
        $this->assertEquals('2019-01-01 09:00:00', $activity['starts_at']);
        $this->assertEquals('2019-01-01 15:30:00', $activity['ends_at']);
        $this->assertEquals(10, $activity['places']);
        $this->assertEquals(1000, $activity['cost']);
        $this->assertEquals(date('Y-m-d H:i:s'), $activity['created_at']);
        $this->assertEquals(date('Y-m-d H:i:s'), $activity['updated_at']);
    }

    /** @test */
    public function it_can_store_a_new_activity()
    {
        $adapter = $this->getAdapter();

        $id = $adapter->store([
            'name' => 'Test Activity',
            'description' => 'This is a test activity',
            'starts_at' => '2019-01-01 09:00:00',
            'ends_at' => '2019-01-01 15:30:00',
            'places' => 10,
            'cost' => 1000,
        ]);

        $activity = $adapter->fetch($id);

        $this->assertEquals('Test Activity', $activity['name']);
        $this->assertEquals('This is a test activity', $activity['description']);
        $this->assertEquals('2019-01-01 09:00:00', $activity['starts_at']);
        $this->assertEquals('2019-01-01 15:30:00', $activity['ends_at']);
        $this->assertEquals(10, $activity['places']);
        $this->assertEquals(1000, $activity['cost']);
        $this->assertEquals(date('Y-m-d H:i:s'), $activity['created_at']);
        $this->assertEquals(date('Y-m-d H:i:s'), $activity['updated_at']);
    }

    /** @test */
    public function it_can_delete_an_activity()
    {
        $adapter = $this->getAdapter();

        $adapter->delete(1);

        $this->assertFalse($adapter->exists(1));
    }

    abstract protected function getAdapter() : AdapterInterface;
}
