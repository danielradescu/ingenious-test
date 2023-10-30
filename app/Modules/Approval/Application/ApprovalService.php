<?php

namespace App\Modules\Approval\Application;

use App\Domain\Enums\StatusEnum;
use App\Modules\Approval\Infrastructure\Persistence\Query\GetEntityStatus;
use App\Modules\Approval\Infrastructure\Persistence\Repositories\ApprovalReadRepository;
use App\Modules\Approval\Infrastructure\Repository\SetApproveStatusForAnEntity;
use Ramsey\Uuid\UuidInterface;

readonly class ApprovalService
{

    public function __construct(
        private ApprovalReadRepository $repository
    )
    {
    }

    public function getEntityStatus(UuidInterface $id, string $entity): StatusEnum
    {
        $repository = new GetEntityStatus($this->repository, $id, $entity);

        return $repository->execute();
    }

}
