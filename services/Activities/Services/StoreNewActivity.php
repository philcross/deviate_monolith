<?php

namespace Deviate\Activities\Services;

use Deviate\Activities\Repositories\StoreActivityRepository;

class StoreNewActivity
{
    private $repository;

    public function __construct(StoreActivityRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($data)
    {
        return $this->repository->store($data);
    }
}
