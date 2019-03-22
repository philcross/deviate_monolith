<?php

namespace Deviate\Activities\Repositories;

use Deviate\Activities\Adapters\AdapterInterface;
use Deviate\Activities\Exceptions\ActivityDoesntExistException;

class FetchActivityRepository
{
    private $adapter;

    public function __construct(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    public function fetchActivity($id)
    {
        $activity = $this->adapter->fetch($id);

        if (empty($activity)) {
            throw new ActivityDoesntExistException;
        }

        return $activity;
    }
}
