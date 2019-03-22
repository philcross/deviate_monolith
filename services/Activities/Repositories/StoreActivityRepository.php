<?php

namespace Deviate\Activities\Repositories;

use Deviate\Activities\Adapters\AdapterInterface;

class StoreActivityRepository
{
    /** @var AdapterInterface */
    private $adapter;

    /**
     * Constructor
     *
     * @param AdapterInterface $adapter
     */
    public function __construct(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * Store a new activity and return the ID
     *
     * @param array $data
     *
     * @return mixed
     */
    public function store(array $data)
    {
        return $this->adapter->store($data);
    }
}
