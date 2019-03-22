<?php

namespace Tests\Unit\Services\Activities\Adapters;

use Illuminate\Support\Facades\DB;
use Deviate\Activities\Adapters\MysqlAdapter;
use Deviate\Activities\Adapters\AdapterInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MysqlAdapterTest extends AbstractAdapterTest
{
    use RefreshDatabase;

    protected function getAdapter(): AdapterInterface
    {
        return new MysqlAdapter(DB::connection('mysql'));
    }

    protected function setUp(): void
    {
        parent::setUp();

        DB::table('activities')->insert([
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
    }
}
