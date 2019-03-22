<?php

namespace Deviate\Activities\Repositories;

use Deviate\Activities\Adapters\AdapterInterface;

class DeleteActivityRepository
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
     * Delete an activity
     *
     * @param mixed $id
     *
     * @return void
     */
    public function deleteById($id)
    {
        $this->adapter->delete([
            'id' => $id
        ]);
    }
}
