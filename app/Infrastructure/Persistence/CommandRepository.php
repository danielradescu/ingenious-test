<?php

namespace App\Infrastructure\Persistence;

use Illuminate\Database\Query\Builder;

abstract class CommandRepository extends DatabaseHandler
{
    public function getConnection(): string
    {
        return empty($this->connection) ? 'mysql_write' : $this->connection;
    }
}
