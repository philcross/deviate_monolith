<?php

namespace Deviate\Activities\Services;

use Deviate\Activities\Repositories\DeleteActivityRepository;

class DeleteActivity
{
    private $repository;

    public function __construct(DeleteActivityRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id)
    {
        $this->repository->deleteActivity($id);
    }
}
