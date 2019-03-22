<?php

namespace Deviate\Activities\Adapters;

use Deviate\Activities\Models\Eloquent\Activity;

class EloquentAdapter implements AdapterInterface
{
    public function store(array $data)
    {
        $model = Activity::create($data);

        return $model->id;
    }

    public function delete($id)
    {
        Activity::find($id)->delete();
    }

    public function exists($id)
    {
        return Activity::where('id', $id)->exists();
    }

    public function fetch($id)
    {
        $model = Activity::find($id);

        if (!$model) {
            return null;
        }

        return (array)$model->toArray();
    }
}
