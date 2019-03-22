<?php

namespace Deviate\Activities\Adapters;

use Ramsey\Uuid\Uuid;
use Illuminate\Support\Arr;

class ArrayAdapter implements AdapterInterface
{
    private $store;

    public function __construct(array $store = [])
    {
        $this->store = $store;
    }

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

    public function fetch($id)
    {
        return Arr::first($this->store, function ($activity) use ($id) {
            return $activity['id'] === $id;
        });
    }

    public function delete($id)
    {
        $this->store = array_filter($this->store, function ($activity) use ($id) {
            return $activity['id'] !== $id;
        });
    }

    public function exists($id)
    {
        return !empty(array_filter($this->store, function ($activity) use ($id) {
            return $activity['id'] === $id;
        }));
    }
}
