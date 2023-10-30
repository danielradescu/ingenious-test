<?php

namespace App\Infrastructure\Persistence;

use Illuminate\Database\Query\Builder;

abstract class DatabaseHandler
{
    protected string $connection;

    //abstract public function execute(): ?object;

    abstract public function getConnection(): string;

    public function setConnection(string $connection): void
    {
        $this->connection = $connection;
    }

}
