<?php

namespace Tests\Unit\Services\Activities\Adapters;

use Deviate\Activities\Adapters\AdapterInterface;
use Deviate\Activities\Adapters\ArrayAdapter;

class ArrayAdapterTest extends AbstractAdapterTest
{
    protected function getAdapter(): AdapterInterface
    {
        return new ArrayAdapter([
            [
                'id' => 1,
                'name' => 'Test Activity',
                'description' => 'This is a test activity',
                'starts_at' => '2019-01-01 09:00:00',
                'ends_at' => '2019-01-01 15:30:00',
                'places' => 10,
                'cost' => 1000,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ]);
    }
}
