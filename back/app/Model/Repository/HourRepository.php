<?php

namespace App\Model\Repository;

class HourRepository extends Repository
{
    public const TABLE = 'actual_song';
    public function getByHourId(int $id): ?\Nette\Database\Table\ActiveRow
    {
        return $this->database
            ->table(self::TABLE)
            ->where('hour_id =', $id)
            ->fetch();
    }
    public function updateSong(int $id, int $song_id): int
    {
        return $this->database
            ->table(self::TABLE)
            ->where('hour_id =', $id)
            ->update([
                'song_id' => $song_id
            ]);
    }

    public function getList(): array
    {
        $configList=[];
        $config = $this->getAll();
        foreach ($config as $c)
        {
            $configList["$c->hour_id"] = $c->song_id;
        }
        return $configList;
    }
}