<?php

namespace App\Modules\Approval\Infrastructure\Persistence\Query;

use App\Infrastructure\Persistence\DatabaseHandler;
use App\Infrastructure\Persistence\PersistenceHandler;
use Ramsey\Uuid\UuidInterface;

readonly class GetEntityStatus implements PersistenceHandler
{
    public function __construct(
        private DatabaseHandler $repository,
        private UuidInterface $uuid,
        private string $entity
    )
    {
    }

    public function execute()
    {
        return $this->repository->getEntityStatus($this->uuid, $this->entity);
    }
}
