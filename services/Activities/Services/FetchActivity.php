<?php

namespace Deviate\Activities\Services;

use Deviate\Activities\Repositories\FetchActivityRepository;

class FetchActivity
{
    private $repository;

    public function __construct(FetchActivityRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id)
    {
        return $this->repository->fetchActivity($id);
    }
}
