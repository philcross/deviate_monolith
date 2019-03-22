<?php

namespace Deviate\Activities\Services;

use Deviate\Activities\Repositories\FetchActivityRepository;

class FetchActivity
{
    /** @var FetchActivityRepository */
    private $repository;

    /**
     * Constructor
     *
     * @param FetchActivityRepository $repository
     */
    public function __construct(FetchActivityRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Run the service
     *
     * @param mixed $id
     *
     * @return array
     *
     * @throws \Deviate\Activities\Exceptions\ActivityDoesntExistException
     */
    public function run($id)
    {
        return $this->repository->fetchById($id);
    }
}
