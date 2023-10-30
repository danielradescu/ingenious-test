<?php

namespace App\Infrastructure\Persistence;

abstract class QueryRepository extends DatabaseHandler
{
    public function getConnection(): string
    {
        return empty($this->connection) ? 'mysql_read' : $this->connection;
    }
}
