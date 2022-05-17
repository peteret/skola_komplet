<?php

namespace App\Model\Repository;

class UploadRepository extends Repository
{
    public const TABLE = 'song';
    public function fetchPairs(): array
    {
        return $this->database
            ->table(self::TABLE)
            ->fetchPairs('song_id', 'name');
    }
}
