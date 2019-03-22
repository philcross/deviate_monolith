<?php

namespace Deviate\Activities\Adapters;

use Illuminate\Database\ConnectionInterface;

class MysqlAdapter implements AdapterInterface
{
    /** @var ConnectionInterface */
    private $connection;

    /**
     * Constructor
     *
     * @param ConnectionInterface $connection
     */
    public function __construct(ConnectionInterface $connection)
    {
        $this->connection = $connection;
    }

    /**
     * {@inheritdoc}
     */
    public function store(array $data)
    {
        $this->connection->insert("
            INSERT INTO activities (name, description, starts_at, ends_at, places, cost, created_at, updated_at)
            VALUES (:name, :description, :starts_at, :ends_at, :places, :cost, NOW(), NOW())
        ", [
            'name'        => $data['name'],
            'description' => $data['description'],
            'starts_at'   => $data['starts_at'],
            'ends_at'     => $data['ends_at'],
            'places'      => $data['places'],
            'cost'        => $data['cost'],
        ]);

        return $this->connection->getPdo()->lastInsertId();
    }

    /**
     * {@inheritdoc}
     */
    public function delete(array $filters): void
    {
        $where = $this->convertFiltersToWhereClause($filters);

        $this->connection->delete("DELETE FROM activities WHERE {$where} LIMIT 1", $filters);
    }

    /**
     * {@inheritdoc}
     */
    public function exists(array $filters): bool
    {
        return !empty($this->fetch($filters));
    }

    /**
     * {@inheritdoc}
     */
    public function fetch(array $filters): ?array
    {
        $where = $this->convertFiltersToWhereClause($filters);

        $records = $this->connection->select("
            SELECT * FROM activities WHERE {$where} LIMIT 1
        ", $filters);

        if (empty($records)) {
            return null;
        }

        return (array)$records[0];
    }

    private function convertFiltersToWhereClause(array $filters)
    {
        $where = array_map(function ($key) {
            return sprintf('%s = :%s', $key, $key);
        }, array_keys($filters));

        return implode(' AND ', $where);
    }
}
