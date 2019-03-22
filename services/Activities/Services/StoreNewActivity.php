<?php

namespace Deviate\Activities\Services;

use Deviate\Activities\Repositories\StoreActivityRepository;

class StoreNewActivity
{
    /** @var StoreActivityRepository */
    private $repository;

    /**
     * Constructor
     *
     * @param StoreActivityRepository $repository
     */
    public function __construct(StoreActivityRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Run the service
     *
     * @param $data
     *
     * @return mixed
     */
    public function run($data)
    {
        return $this->repository->store($data);
    }
}
