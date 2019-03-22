<?php

namespace Deviate\Activities\Services;

use Deviate\Activities\Repositories\DeleteActivityRepository;

class DeleteActivity
{
    /** @var DeleteActivityRepository */
    private $repository;

    /**
     * Constructor
     *
     * @param DeleteActivityRepository $repository
     */
    public function __construct(DeleteActivityRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Run the service
     *
     * @param mixed $id
     */
    public function run($id)
    {
        $this->repository->deleteById($id);
    }
}
