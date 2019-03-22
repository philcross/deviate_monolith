<?php

namespace Deviate\Activities\Adapters;

use Ramsey\Uuid\Uuid;
use Illuminate\Support\Arr;

class ArrayAdapter implements AdapterInterface
{
    /** @var array */
    private $store;

    /**
     * Constructor
     *
     * @param array $store
     */
    public function __construct(array $store = [])
    {
        $this->store = $store;
    }

    /**
     * {@inheritdoc}
     */
    public function store(array $data)
    {
        $store = [
            'id'          => Uuid::uuid4()->toString(),
            'name'        => $data['name'],
            'description' => $data['description'],
            'starts_at'   => $data['starts_at'],
            'ends_at'     => $data['ends_at'],
            'places'      => $data['places'],
            'cost'        => $data['cost'],
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ];

        $this->store[] = $store;

        return $store['id'];
    }

    /**
     * {@inheritdoc}
     */
    public function fetch(array $filters): ?array
    {
        return Arr::first($this->store, function ($activity) use ($filters) {
            return !empty(array_intersect($activity, $filters));
        });
    }

    /**
     * {@inheritdoc}
     */
    public function delete(array $filters): void
    {
        $this->store = array_filter($this->store, function ($activity) use ($filters) {
            return empty(array_intersect($activity, $filters));
        });
    }

    /**
     * {@inheritdoc}
     */
    public function exists(array $filters): bool
    {
        return !empty($this->fetch($filters));
    }
}
