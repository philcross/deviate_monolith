<?php

namespace Deviate\Activities\Adapters;

use Illuminate\Database\ConnectionInterface;

class MysqlAdapter implements AdapterInterface
{
    private $connection;

    public function __construct(ConnectionInterface $connection)
    {
        $this->connection = $connection;
    }

    public function store(array $data)
    {
        $this->connection->insert("
            INSERT INTO activities (name, description, starts_at, ends_at, places, cost, created_at, updated_at)
            VALUES (:name, :description, :starts_at, :ends_at, :places, :cost, NOW(), NOW())
        ", [
            'name' => $data['name'],
            'description' => $data['description'],
            'starts_at' => $data['starts_at'],
            'ends_at' => $data['ends_at'],
            'places' => $data['places'],
            'cost' => $data['cost'],
        ]);

        return $this->connection->getPdo()->lastInsertId();
    }

    public function delete($id)
    {
        $this->connection->delete("DELETE FROM activities WHERE id = :id LIMIT 1", [
            'id' => $id,
        ]);
    }

    public function exists($id)
    {
        return !empty($this->fetch($id));
    }

    public function fetch($id)
    {
        $records = $this->connection->select("
            SELECT * FROM activities WHERE id = :id LIMIT 1
        ", [
            'id' => $id,
        ]);

        if (empty($records)) {
            return null;
        }

        return (array)$records[0];
    }
}
