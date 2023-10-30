<?php

namespace App\Modules\Approval\Infrastructure\Persistence\Command;

use App\Infrastructure\Persistence\DatabaseHandler;
use App\Infrastructure\Persistence\PersistenceHandler;
use App\Modules\Approval\Api\Dto\ApprovalDto;

readonly class SetApproveStatusForAnEntity implements PersistenceHandler
{
    public function __construct(
        private DatabaseHandler $repository,
        private ApprovalDto     $approvalDto
    )
    {
    }

    public function execute(): int
    {
        return $this->repository->approve($this->approvalDto);
    }
}
