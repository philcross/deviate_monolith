<?php

namespace Deviate\Activities\Adapters;

interface AdapterInterface
{
    /**
     * Create a new activity in the storage, and return it's ID
     *
     * @param array $data
     *
     * @return mixed
     */
    public function store(array $data);

    /**
     * Find an activity by it's ID and return it as an array, or null if no activity can be found
     *
     * @param array $filters
     *
     * @return array|null
     */
    public function fetch(array $filters): ?array;

    /**
     * Delete an activity by it's ID
     *
     * @param array $filters
     *
     * @return void
     */
    public function delete(array $filters): void;

    /**
     * Check to see if an activity exists by it's ID
     *
     * @param array $filters
     *
     * @return boolean
     */
    public function exists(array $filters): bool;
}
