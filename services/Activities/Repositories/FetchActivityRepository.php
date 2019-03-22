<?php

namespace Deviate\Activities\Repositories;

use Deviate\Activities\Adapters\AdapterInterface;
use Deviate\Activities\Exceptions\ActivityDoesntExistException;

class FetchActivityRepository
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
     * Fetch an activity
     *
     * @param mixed $id
     *
     * @return array
     *
     * @throws ActivityDoesntExistException
     */
    public function fetchById($id)
    {
        $activity = $this->adapter->fetch([
            'id' => $id
        ]);

        if (empty($activity)) {
            throw new ActivityDoesntExistException;
        }

        return $activity;
    }
}
