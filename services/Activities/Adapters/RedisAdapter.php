<?php

namespace Deviate\Activities\Adapters;

use Illuminate\Contracts\Redis\Connection;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Redis;

class RedisAdapter implements AdapterInterface
{
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function store(array $data)
    {
        $data = array_merge($data, [
            'id'         => Uuid::uuid4()->toString(),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        $this->connection->rpush('activities', json_encode($data));

        return $data['id'];
    }

    public function delete($id)
    {
        $activity = $this->fetch($id);

        $this->connection->lrem('activities', 0, json_encode($activity));
    }

    public function exists($id)
    {
        return !is_null($this->fetch($id));
    }

    public function fetch($id)
    {
        $activity = Arr::first($this->connection->lrange('activities', 0, -1), function ($entry) use ($id) {
            $entry = json_decode($entry, true);

            return $entry['id'] === $id;
        });

        return $activity ? json_decode($activity, true) : null;
    }
}
