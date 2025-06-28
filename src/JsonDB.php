<?php

declare(strict_types=1);

namespace Json\Database;

class JsonDB
{
    private string $dbPath;

    public function __construct(string $dbPath)
    {
        $this->dbPath = rtrim($dbPath, '/');
    }

    public function insert(string $collection, array $document): bool
    {
        $file = "{$this->dbPath}/{$collection}.json";
        $data = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
        $document['_id'] = uniqid();
        $data[] = $document;

        return file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT)) !== false;
    }

    public function findAll(string $collection): array
    {
        $file = "{$this->dbPath}/{$collection}.json";

        return file_exists($file) ? json_decode(file_get_contents($file), true) : [];
    }

    public function find(string $collection, callable $filter): array
    {
        return array_values(array_filter($this->findAll($collection), $filter));
    }

    public function update(string $collection, callable $filter, callable $updater): int
    {
        $file = "{$this->dbPath}/{$collection}.json";
        $data = $this->findAll($collection);
        $count = 0;

        foreach ($data as &$doc) {
            if ($filter($doc)) {
                $updater($doc);
                $count++;
            }
        }

        file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));

        return $count;
    }

    public function delete(string $collection, callable $filter): int
    {
        $file = "{$this->dbPath}/{$collection}.json";
        $data = $this->findAll($collection);
        $originalCount = count($data);
        $data = array_filter($data, fn ($doc) => ! $filter($doc));
        file_put_contents($file, json_encode(array_values($data), JSON_PRETTY_PRINT));

        return $originalCount - count($data);
    }
}
