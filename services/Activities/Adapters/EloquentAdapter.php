<?php

namespace Deviate\Activities\Adapters;

use Deviate\Activities\Models\Eloquent\Activity;

class EloquentAdapter implements AdapterInterface
{
    /**
     * {@inheritdoc}
     */
    public function store(array $data)
    {
        $model = Activity::create($data);

        return $model->id;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(array $filters): void
    {
        Activity::where($filters)->delete();
    }

    /**
     * {@inheritdoc}
     */
    public function exists(array $filters): bool
    {
        return Activity::where($filters)->count() > 0;
    }

    /**
     * {@inheritdoc}
     */
    public function fetch(array $filters): ?array
    {
        $model = Activity::where($filters)->first();

        if (!$model) {
            return null;
        }

        return (array)$model->toArray();
    }
}
