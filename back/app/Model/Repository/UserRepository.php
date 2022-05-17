<?php

namespace App\Model\Repository;

class UserRepository extends Repository
{
    public const TABLE = 'user';

    public function getUserByEmail(mixed $email): ?\Nette\Database\Table\ActiveRow
    {
        return $this->database
            ->table(self::TABLE)
            ->where('nick =', $email)
            ->fetch();
    }

    public function fetchPairs(): array
    {
        return $this->database
            ->table(self::TABLE)
            ->fetchPairs('user_id', 'name');
    }
}
