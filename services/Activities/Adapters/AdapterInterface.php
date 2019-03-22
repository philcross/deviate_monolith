<?php

namespace Deviate\Activities\Adapters;

interface AdapterInterface
{
    public function store(array $data);

    public function fetch($id);

    public function delete($id);

    public function exists($id);
}
