<?php

namespace Deviate\Activities\Adapters;

use Ramsey\Uuid\Uuid;
use Illuminate\Support\Arr;
use Illuminate\Contracts\Redis\Connection;

class RedisAdapter implements AdapterInterface
{
    /** @var Connection */
    private $connection;

    /**
     * Constructor
     *
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * {@inheritdoc}
     */
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

    /**
     * {@inheritdoc}
     */
    public function delete(array $filters): void
    {
        $activity = $this->fetch($filters);

        $this->connection->lrem('activities', 0, json_encode($activity));
    }

    /**
     * {@inheritdoc}
     */
    public function exists(array $filters): bool
    {
        return !is_null($this->fetch($filters));
    }

    /**
     * {@inheritdoc}
     */
    public function fetch(array $filters): ?array
    {
        $activity = Arr::first($this->connection->lrange('activities', 0, -1), function ($entry) use ($filters) {
            return !empty(array_intersect(json_decode($entry, true), $filters));
        });

        return $activity ? json_decode($activity, true) : null;
    }
}
