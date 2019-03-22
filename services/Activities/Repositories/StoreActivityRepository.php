<?php

namespace Deviate\Activities\Repositories;

use Deviate\Activities\Adapters\AdapterInterface;

class StoreActivityRepository
{
    private $adapter;

    public function __construct(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    public function store(array $data)
    {
        return $this->adapter->store($data);
    }
}
