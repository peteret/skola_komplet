<?php

namespace App\Model\Repository;

use Nette\Database\Explorer;

class Repository
{
    public function __construct(
        protected Explorer $database
    ) {
    }

    public function getAll(): array
    {
        return $this->database
            ->table($this::TABLE)
            ->fetchAll();
    }

    public function getById(int $id): ?\Nette\Database\Table\ActiveRow
    {
        return $this->database
            ->table($this::TABLE)
            ->where($this::TABLE . '_id =', $id)
            ->fetch();
    }

    public function insert(array $data)
    {
        return $this->database
            ->table($this::TABLE)
            ->insert($data);
    }

    public function delete(int $id): int
    {
        return $this->database
            ->table($this::TABLE)
            ->where($this::TABLE . '_id =', $id)
            ->delete();
    }

    public function update(int $id, array $data): int
    {
        return $this->database
            ->table($this::TABLE)
            ->where($this::TABLE . '_id =', $id)
            ->update($data);
    }
}
